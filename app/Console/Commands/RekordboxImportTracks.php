<?php

namespace App\Console\Commands;

use App\Enums\LibrarySource;
use App\Models\CanonicalTrack;
use App\Models\LibraryArtist;
use App\Models\LibraryTrack;
use App\Models\Rekordbox\RekordboxTrack;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\OutputInterface;

class RekordboxImportTracks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rekordbox:import-tracks {user}}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports the tracks from the rekordbox database';

    protected User $user;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->user = User::query()->findOrFail($this->argument('user'));
        $this->info("Importing Tracks for User: {$this->user->email}");

        $existingTracks = $this->user->libraryTracks()
            ->select('source_track_id')
            ->where('source', LibrarySource::REKORDBOX)
            ->pluck('source_track_id');

        $newTrackCount = 0;

        RekordboxTrack::query()
            ->with('rekordboxKey')
            ->whereNotIn(
                'ID',
                $existingTracks
            )->chunk(500, function (Collection $trackCollection) use (&$newTrackCount) {
                /** @var Collection<LibraryTrack> $libraryArtists */
                $libraryArtists = $this->user->libraryArtists()
                    ->where('source', LibrarySource::REKORDBOX)
                    ->whereIn('source_artist_id', $trackCollection->pluck('ArtistID'))
                    ->get()
                    ->keyBy('source_artist_id');

                // Load these separately due to the different database connection
                $libraryArtists->load('canonicalArtist');

                $trackCollection
                    ->filter(function (RekordboxTrack $rekordboxTrack) use ($libraryArtists) {
                        // Skip any tracks with an empty title
                        $title = Str::trim($rekordboxTrack->Title);
                        if (Str::length($title) === 0) {
                            $this->warn("Skipping track: $rekordboxTrack->ID as it has no title", OutputInterface::VERBOSITY_VERBOSE);

                            return false;
                        }

                        /** @var LibraryArtist $libraryArtist */
                        $libraryArtist = $libraryArtists->get($rekordboxTrack->ArtistID);

                        // Skip any tracks that have an artist and we have yet to import the artist for
                        if ($rekordboxTrack->ArtistID !== null) {
                            if ($libraryArtist === null) {
                                $this->warn("Skipping track: $title ($rekordboxTrack->ID) as libraryArtist artist with Rekordbox ID $rekordboxTrack->ArtistID doesn't exist");

                                return false;
                            }

                            $canonicalArtist = $libraryArtist->canonicalArtist;
                            if ($canonicalArtist === null) {
                                $this->warn("Skipping track: $title ($rekordboxTrack->ID) as libraryArtist artist with ID $libraryArtist->id doesn't have a canonical artist set");

                                return false;
                            }
                        }


                        return true;
                    })->each(function (RekordboxTrack $rekordboxTrack) use (&$newTrackCount, $libraryArtists) {
                        $title = Str::trim($rekordboxTrack->Title);

                        /** @var ?LibraryArtist $libraryArtist */
                        $libraryArtist = $libraryArtists->get($rekordboxTrack->ArtistID);
                        $canonicalArtist = $libraryArtist?->canonicalArtist ?? null;

                        $this->info("Creating Track: $title ($rekordboxTrack->ID) with Artist ID $rekordboxTrack->ArtistID", OutputInterface::VERBOSITY_VERBOSE);

                        $baseData = [
                            'title' => $title,
                            'bpm' => $rekordboxTrack->BPM / 100,
                            'duration' => $rekordboxTrack->Length,
                            'key' => $rekordboxTrack->rekordboxKey?->ScaleName,
                            'user_id' => $this->user->getKey(),
                        ];

                        $canonicalTrack = CanonicalTrack::query()->create([
                            ...$baseData,
                            'canonical_artist_id' => $canonicalArtist?->id ?? null,
                        ]);

                        LibraryTrack::query()->create([
                            ...$baseData,
                            'canonical_track_id' => $canonicalTrack->id,
                            'library_artist_id' => $libraryArtist->id ?? null,
                            'source' => LibrarySource::REKORDBOX,
                            'source_track_id' => $rekordboxTrack->ID,
                        ]);

                        $newTrackCount++;
                    });
            });

        $this->info("Imported $newTrackCount new tracks");

        return self::SUCCESS;
    }
}
