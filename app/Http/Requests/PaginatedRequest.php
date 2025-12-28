<?php

namespace App\Http\Requests;

class PaginatedRequest extends InertiaFormRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'order_by' => 'nullable|string',
            'order_direction' => 'nullable|string',
            'per_page' => 'nullable|integer',
        ]);
    }

    public function getDefaultOrderBy(): string
    {
        return 'id';
    }

    public function getOrderBy(): string
    {
        return $this->input('order_by', $this->getDefaultOrderBy());
    }

    public function getDefaultOrderDirection(): string
    {
        return 'desc';
    }

    public function getOrderDirection(): string
    {
        return $this->input('order_direction', $this->getDefaultOrderDirection());
    }

    public function getDefaultPerPage(): int
    {
        return 15;
    }

    public function getPerPage(): int
    {
        return $this->input('per_page', $this->getDefaultPerPage());
    }
}
