<?php

namespace App\Http\Requests\Library;

use App\Http\Requests\PaginatedRequest;

class LibraryArtistIndexRequest extends PaginatedRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'library' => 'nullable|int|exists:libraries,id',
            'search' => 'nullable|string',
        ]);
    }

    public function getDefaultOrderBy(): string
    {
        return 'name';
    }

    public function getDefaultOrderDirection(): string
    {
        return 'asc';
    }
}
