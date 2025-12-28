<?php

namespace App\Http\Resources;

use App\Http\Resources\Library\LibraryResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * This is the resource that should typically be used via other resources,
 * where we don't need to expose a user's email, name etc.
 */
class DjUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var User $user */
        $user = $this->resource;

        return [
            'id' => $user->id,
            'created_at' => $user->created_at,

            'dj_name' => $user->dj_name,

            'libraries' => LibraryResource::collection($this->whenLoaded('libraries')),
        ];
    }
}
