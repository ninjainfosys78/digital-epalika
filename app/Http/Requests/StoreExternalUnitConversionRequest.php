<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExternalUnitConversionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'conversion' => ['required', 'array'],
            'conversion.*.conversion_to' => ['required', Rule::exists('units', 'id')->withoutTrashed()],
            'conversion.*.rate' => ['required', 'numeric'],
        ];
    }
}
