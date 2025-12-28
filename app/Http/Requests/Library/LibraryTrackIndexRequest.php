<?php

namespace App\Http\Requests\Library;

use App\Http\Requests\PaginatedRequest;

class LibraryTrackIndexRequest extends PaginatedRequest
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
        return 'title';
    }

    public function getDefaultOrderDirection(): string
    {
        return 'asc';
    }
}
