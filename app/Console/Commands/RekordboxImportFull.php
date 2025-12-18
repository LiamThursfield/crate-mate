<?php

namespace App\Console\Commands;

use App\Enums\LibrarySource;
use App\Models\Library;
use Illuminate\Console\Command;

class RekordboxImportFull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rekordbox:import-full {library}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs all of the Rekordbox import commands';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // Ensure a Rekordbox Library exists with the given ID
        Library::query()
            ->where('id', $this->argument('library'))
            ->where('source', LibrarySource::REKORDBOX)
            ->firstOrFail();

        $this->info('Importing Artists');
        $this->call('rekordbox:import-artists', [
            'library' => $this->argument('library'),
        ]);

        $this->line('');

        $this->info('Importing Tracks');
        $this->call('rekordbox:import-tracks', [
            'library' => $this->argument('library'),
        ]);

        return self::SUCCESS;
    }
}
