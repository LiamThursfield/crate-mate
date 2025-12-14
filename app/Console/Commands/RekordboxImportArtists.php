<?php

namespace App\Console\Commands;

use App\Enums\LibrarySource;
use App\Models\CanonicalArtist;
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
    protected $signature = 'rekordbox:import-artists {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports the artists from the rekordbox database';

    protected User $user;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->user = User::query()->findOrFail($this->argument('user'));
        $this->info("Importing Artists for User: {$this->user->email}");

        $existingArtists = $this->user->libraryArtists()
            ->select('source_artist_id')
            ->where('source', LibrarySource::REKORDBOX)
            ->pluck('source_artist_id');

        $newArtistsCount = 0;

        RekordboxArtist::query()->whereNotIn(
            'ID',
            $existingArtists
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
                    'user_id' => $this->user->getKey(),
                    'source' => LibrarySource::REKORDBOX,
                    'source_artist_id' => $rekordboxArtist->ID,
                ]);

                $newArtistsCount++;
            });
        });

        $this->info("Imported $newArtistsCount new artists");

        return self::SUCCESS;
    }
}
