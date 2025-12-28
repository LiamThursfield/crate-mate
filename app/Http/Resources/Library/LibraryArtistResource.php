<?php

namespace App\Http\Resources\Library;

use App\Http\Resources\Canonical\CanonicalArtistResource;
use App\Models\LibraryArtist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LibraryArtistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var LibraryArtist $artist */
        $artist = $this->resource;

        return [
            'id' => $artist->id,
            'created' => $artist->created_at,

            'name' => $artist->name,

            'canonical_artist_id' => $artist->canonical_artist_id,
            'canonical_artist' => CanonicalArtistResource::make($this->whenLoaded('canonicalArtist')),

            'library_id' => $artist->library_id,
            'library' => LibraryResource::make($this->whenLoaded('library')),

            'library_track_count' => $artist->library_tracks_count,
        ];
    }
}
