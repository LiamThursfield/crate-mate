<?php

namespace App\Console\Commands;

use App\Enums\LibrarySource;
use App\Models\Library;
use App\Models\LibraryHistory;
use App\Models\Rekordbox\RekordboxHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\OutputInterface;

class RekordboxImportHistories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rekordbox:import-histories {library}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports the histories from the rekordbox database';

    protected Library $library;

    protected User $user;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // Ensure a Rekordbox Library exists with the given ID
        $this->library = Library::query()
            ->where('id', $this->argument('library'))
            ->where('source', LibrarySource::REKORDBOX)
            ->firstOrFail();

        $this->user = $this->library->user;

        $this->info("Importing Histories for Library: {$this->library->name} belonging to user: {$this->user->email}");

        $existingHistoryIds = $this->library->histories()
            ->select('source_history_id')
            ->pluck('source_history_id');

        $newHistoryIds = 0;

        RekordboxHistory::query()->whereNotIn(
            'ID',
            $existingHistoryIds
        )->where(
            'Attribute', 0
        )->chunk(500, function (Collection $historyCollection) use (&$newHistoryIds) {
            $historyCollection->each(function (RekordboxHistory $rekordboxHistory) use (&$newHistoryIds) {
                $name = Str::trim($rekordboxHistory->Name);

                $this->info("Creating History: $name ($rekordboxHistory->ID)", OutputInterface::VERBOSITY_VERBOSE);

                LibraryHistory::query()->create([
                    'name' => $name,
                    'date' => Carbon::parse($rekordboxHistory->DateCreated),
                    'include_in_stats' => true, // include all histories in stats by default
                    'library_id' => $this->library->getKey(),
                    'source_history_id' => $rekordboxHistory->ID,
                ]);

                $newHistoryIds++;
            });
        });

        $this->info("Imported $newHistoryIds new histories");

        return self::SUCCESS;
    }
}
