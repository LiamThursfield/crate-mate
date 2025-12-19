<?php

namespace App\Console\Commands;

use App\Enums\LibrarySource;
use App\Models\CanonicalTrack;
use App\Models\Library;
use App\Models\LibraryArtist;
use App\Models\LibraryTrack;
use App\Models\Rekordbox\RekordboxTrack;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\OutputInterface;

class RekordboxImportTracks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rekordbox:import-tracks {library}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports the tracks from the rekordbox database';

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

        $this->info("Importing Tracks for Library: {$this->library->name} belonging to user: {$this->user->email}");

        $existingSourceTrackIds = $this->library->tracks()
            ->select('source_track_id')
            ->pluck('source_track_id');

        $newTrackCount = 0;

        RekordboxTrack::query()
            ->with('rekordboxKey')
            ->whereNotIn(
                'ID',
                $existingSourceTrackIds
            )->chunk(500, function (Collection $trackCollection) use (&$newTrackCount) {
                /** @var Collection<RekordboxTrack> $trackCollection */

                /** @var DatabaseCollection<LibraryArtist> $libraryArtists */
                $libraryArtists = $this->library->artists()
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

                        /** @var LibraryArtist|null $libraryArtist */
                        $libraryArtist = $libraryArtists->get($rekordboxTrack->ArtistID);

                        // Skip any tracks that have an artist and we have yet to import the artist for
                        if ($rekordboxTrack->ArtistID !== null && $libraryArtist === null) {
                            $this->warn("Skipping track: $title ($rekordboxTrack->ID) as libraryArtist artist with Rekordbox ID $rekordboxTrack->ArtistID doesn't exist");

                            return false;
                        }

                        return true;
                    })->each(function (RekordboxTrack $rekordboxTrack) use (&$newTrackCount, $libraryArtists) {
                        $title = Str::trim($rekordboxTrack->Title);

                        /** @var LibraryArtist|null $libraryArtist */
                        $libraryArtist = $libraryArtists->get($rekordboxTrack->ArtistID);
                        $canonicalArtist = $libraryArtist?->canonicalArtist;

                        $this->info("Creating Track: $title ($rekordboxTrack->ID) with Artist ID $rekordboxTrack->ArtistID ($libraryArtist?->id)", OutputInterface::VERBOSITY_VERBOSE);

                        $baseData = [
                            'title' => $title,
                            'bpm' => $rekordboxTrack->BPM / 100,
                            'duration' => $rekordboxTrack->Length,
                            'key' => $rekordboxTrack->rekordboxKey?->ScaleName,
                        ];

                        $canonicalTrack = CanonicalTrack::query()->create([
                            ...$baseData,
                            'canonical_artist_id' => $canonicalArtist?->id,
                            'user_id' => $this->user->getKey(),
                        ]);

                        LibraryTrack::query()->create([
                            ...$baseData,
                            'canonical_track_id' => $canonicalTrack->id,
                            'library_artist_id' => $libraryArtist->id ?? null,
                            'library_id' => $this->library->getKey(),
                            'source_track_id' => $rekordboxTrack->ID,
                        ]);

                        $newTrackCount++;
                    });
            });

        $this->info("Imported $newTrackCount new tracks");

        return self::SUCCESS;
    }
}
