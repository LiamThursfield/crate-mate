<?php

namespace App\Console\Commands;

use App\Enums\LibrarySource;
use App\Models\CanonicalArtist;
use App\Models\Library;
use App\Models\LibraryArtist;
use App\Models\Rekordbox\RekordboxArtist;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\OutputInterface;

class RekordboxImportArtists extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rekordbox:import-artists {library}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports the artists from the rekordbox database';

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

        $this->info("Importing Artists for Library: {$this->library->name} belonging to user: {$this->user->email}");

        $existingSourceArtistIds = $this->library->artists()
            ->select('source_artist_id')
            ->pluck('source_artist_id');

        $newArtistsCount = 0;

        RekordboxArtist::query()->whereNotIn(
            'ID',
            $existingSourceArtistIds
        )->chunk(500, function (Collection $artistCollection) use (&$newArtistsCount) {
            $artistCollection->each(function (RekordboxArtist $rekordboxArtist) use (&$newArtistsCount) {
                $name = Str::trim($rekordboxArtist->Name);

                $this->info("Creating Artist: $name ($rekordboxArtist->ID)", OutputInterface::VERBOSITY_VERBOSE);

                $canonicalArtist = CanonicalArtist::query()->create([
                    'name' => $name,
                    'user_id' => $this->user->getKey(),
                ]);

                LibraryArtist::query()->create([
                    'name' => $name,
                    'canonical_artist_id' => $canonicalArtist->id,
                    'library_id' => $this->user->getKey(),
                    'source_artist_id' => $rekordboxArtist->ID,
                ]);

                $newArtistsCount++;
            });
        });

        $this->info("Imported $newArtistsCount new artists");

        return self::SUCCESS;
    }
}
