<?php

namespace Modules\Plan\Http\Requests\Material;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'material_type_id' => ['required', 'exists:material_types,id'],
            'title' => ['required', 'string', 'max:255'],
            'unit_id' => ['required', 'exists:units,id'],
            'density' => ['required'],
        ];
    }
}
