<?php

namespace Modules\Plan\Http\Requests\MaterialCollection;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialCollectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'material_rate_id' => ['required'],
            'unit_id' => ['required'],
            'activity_no' => ['required'],
            'remarks' => ['required'],
            'fiscal_year_id' => ['required']
        ];
    }
}
