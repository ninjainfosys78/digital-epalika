<?php

namespace Modules\Plan\Http\Requests\MaterialRate;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialRateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'material_id' => ['required'],
            'fiscal_year_id' => ['required'],
            'is_vat_included' => ['nullable', 'boolean'],
            'is_vat_needed' => ['nullable', 'boolean'],
            'referance_no' => ['nullable'],
            'royalty' => ['required'],
        ];
    }
}
