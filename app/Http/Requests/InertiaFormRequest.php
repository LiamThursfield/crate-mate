<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InertiaFormRequest extends FormRequest
{
    // This status code will trigger Inertia to preserve the current page
    // See: https://inertiajs.com/docs/v2/the-basics/redirects#303-response-code
    public int $status = 303;

    public function rules(): array
    {
        return [];
    }
}
