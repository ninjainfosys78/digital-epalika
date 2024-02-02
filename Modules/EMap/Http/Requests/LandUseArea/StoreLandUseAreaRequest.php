<?php

namespace Modules\EMap\Http\Requests\LandUseArea;

use Illuminate\Foundation\Http\FormRequest;

class StoreLandUseAreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'coordinates' => ['nullable', 'json']
        ];
    }
}
