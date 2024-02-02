<?php

namespace Modules\Plan\Http\Requests\FuelRate;

use Illuminate\Foundation\Http\FormRequest;

class StoreFuelRateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rate' => ['required'],
            'has_included_vat' => ['nullable', 'boolean'],
            'fuel_id' => ['required', 'integer', 'exists:fuels,id']
        ];
    }
}
