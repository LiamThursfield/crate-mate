<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class RekordboxImportFull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rekordbox:import-full {user}';

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
        // Ensure the user exists
        User::query()->findOrFail($this->argument('user'));

        $this->info('Importing Artists');
        $this->call('rekordbox:import-artists', [
            'user' => $this->argument('user'),
        ]);

        $this->line('');

        $this->info('Importing Tracks');
        $this->call('rekordbox:import-tracks', [
            'user' => $this->argument('user'),
        ]);

        return self::SUCCESS;
    }
}
