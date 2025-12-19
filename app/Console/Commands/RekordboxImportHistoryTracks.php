<?php

namespace App\Console\Commands;

use App\Enums\LibrarySource;
use App\Models\Library;
use App\Models\LibraryHistory;
use App\Models\LibraryHistoryTrack;
use App\Models\LibraryTrack;
use App\Models\Rekordbox\RekordboxSongHistory;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Output\OutputInterface;

class RekordboxImportHistoryTracks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rekordbox:import-history-tracks {library}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports the history tracks from the rekordbox database';

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

        $this->info("Importing History Tracks for Library: {$this->library->name} belonging to user: {$this->user->email}");

        $existingHistoryTrackIds = $this->library->historyTracks()
            ->select('source_history_track_id')
            ->pluck('source_history_track_id');

        $newHistoryTrackIds = 0;

        RekordboxSongHistory::query()->whereNotIn(
            'ID',
            $existingHistoryTrackIds
        )->chunk(500, function (Collection $songHistoryCollection) use (&$newHistoryTrackIds) {
            /** @var Collection<RekordboxSongHistory> $songHistoryCollection */

            /** @var Collection<LibraryTrack> $libraryTracks */
            $libraryTracks = $this->library->tracks()
                ->whereIn('source_track_id', $songHistoryCollection->pluck('ContentID'))
                ->get()
                ->keyBy('source_track_id');

            /** @var Collection<LibraryHistory> $libraryHistories */
            $libraryHistories = $this->library->histories()
                ->whereIn('source_history_id', $songHistoryCollection->pluck('HistoryID'))
                ->get()
                ->keyBy('source_history_id');

            $songHistoryCollection
                ->filter(function (RekordboxSongHistory $rekordboxSongHistory) use ($libraryTracks, $libraryHistories) {
                    $libraryHistory = $libraryHistories->get($rekordboxSongHistory->HistoryID);

                    // Skip any song histories that have no library history
                    if ($libraryHistory === null) {
                        $this->warn("Skipping History Track: $rekordboxSongHistory->ID as it has no Library History with Rekordbox History ID: $rekordboxSongHistory->HistoryID", OutputInterface::VERBOSITY_VERBOSE);

                        return false;
                    }

                    $libraryTrack = $libraryTracks->get($rekordboxSongHistory->ContentID);

                    // Skip any song histories that have no library track
                    if ($libraryTrack === null) {
                        $this->warn("Skipping History Track: $rekordboxSongHistory->ID as it has no Library Track with Rekordbox ID: $rekordboxSongHistory->ContentID", OutputInterface::VERBOSITY_VERBOSE);

                        return false;
                    }

                    return true;
                })->each(function (RekordboxSongHistory $rekordboxSongHistory) use (&$newHistoryTrackIds, $libraryTracks, $libraryHistories) {
                    /** @var LibraryHistory $libraryHistory */
                    $libraryHistory = $libraryHistories->get($rekordboxSongHistory->HistoryID);

                    /** @var LibraryTrack $libraryTrack */
                    $libraryTrack = $libraryTracks->get($rekordboxSongHistory->ContentID);

                    $this->info("Creating History Track: $rekordboxSongHistory->ID with Content ID: $rekordboxSongHistory->ContentID for Library Track: $libraryTrack->title", OutputInterface::VERBOSITY_VERBOSE);

                    LibraryHistoryTrack::query()->create([
                        'library_history_id' => $libraryHistory->id,
                        'library_track_id' => $libraryTrack->id,
                        'track_no' => $rekordboxSongHistory->TrackNo,
                        'date' => $rekordboxSongHistory->created_at,
                        'library_id' => $this->library->id,
                        'source_history_track_id' => $rekordboxSongHistory->ID,
                    ]);

                    $newHistoryTrackIds++;
                });
        });

        $this->info("Imported $newHistoryTrackIds new history tracks");

        return self::SUCCESS;
    }
}
