<?php

namespace App\Http\Resources\Canonical;

use App\Http\Resources\DjUserResource;
use App\Http\Resources\Library\LibraryTrackResource;
use App\Models\CanonicalTrack;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CanonicalTrackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var CanonicalTrack $track */
        $track = $this->resource;

        return [
            'id' => $track->id,
            'created_at' => $track->created_at,

            'bpm' => $track->bpm,
            'duration' => $track->duration,
            'is_verified' => $track->verified_at !== null,
            'key' => $track->key,
            'title' => $track->title,
            'verified_at' => $track->verified_at,

            'canonical_artist' => CanonicalArtistResource::make($this->whenLoaded('canonicalArtist')),
            'canonical_artist_id' => $track->canonical_artist_id,

            'library_tracks_count' => $track->library_tracks_count,
            'library_tracks' => LibraryTrackResource::collection($this->whenLoaded('libraryTracks')),

            'user_id' => $track->user_id,
            'user' => DjUserResource::make($this->whenLoaded('user')),
        ];
    }
}
