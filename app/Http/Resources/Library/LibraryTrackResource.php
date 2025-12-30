<?php

namespace App\Http\Resources\Library;

use App\Http\Resources\Canonical\CanonicalTrackResource;
use App\Models\LibraryTrack;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LibraryTrackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var LibraryTrack $track */
        $track = $this->resource;

        return [
            'id' => $track->id,
            'created' => $track->created_at,

            'bpm' => $track->bpm,
            'duration' => $track->duration,
            'duration_formatted' => $track->getDurationAsMinutesAndSeconds(),
            'key' => $track->key,
            'title' => $track->title,

            'canonical_artist_id' => $track->canonical_track_id,
            'canonical_track' => CanonicalTrackResource::make(
                $this->whenLoaded('canonicalTrack')
            ),

            'library_id' => $track->library_id,
            'library' => LibraryResource::make(
                $this->whenLoaded('library')
            ),

            'library_artist_id' => $track->library_artist_id,
            'library_artist' => LibraryArtistResource::make(
                $this->whenLoaded('libraryArtist')
            ),
        ];
    }
}
