<?php

namespace App\Http\Resources\Canonical;

use App\Http\Resources\DjUserResource;
use App\Models\CanonicalArtist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CanonicalArtistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var CanonicalArtist $artist */
        $artist = $this->resource;

        return [
            'id' => $artist->id,
            'created_at' => $artist->created_at,

            'is_verified' => $artist->verified_at !== null,
            'name' => $artist->name,
            'verified_at' => $artist->verified_at,

            'user_id' => $artist->user_id,
            'user' => DjUserResource::make($this->whenLoaded('user')),
        ];
    }
}
