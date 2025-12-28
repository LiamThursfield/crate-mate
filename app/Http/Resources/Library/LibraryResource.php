<?php

namespace App\Http\Resources\Library;

use App\Http\Resources\DjUserResource;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LibraryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Library $library */
        $library = $this->resource;

        return [
            'id' => $library->id,
            'created_at' => $library->created_at,

            'name' => $library->name,
            'source' => $library->source,

            'user_id' => $library->user_id,
            'user' => DjUserResource::make($library->user),
        ];
    }
}
