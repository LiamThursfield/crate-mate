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
            'bpm_min' => 'nullable|int|min:1',
            'bpm_max' => 'nullable|int|min:1',
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

    /**
     * Add additional validation for BPM
     *
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $bpmMin = $this->input('bpm_min');
            $bpmMax = $this->input('bpm_max');

            if ($bpmMin !== null && $bpmMax !== null && (int) $bpmMin > (int) $bpmMax) {
                $validator->errors()->add('bpm_min', 'Minimum BPM cannot be greater than maximum BPM.');
            }
        });
    }
}
