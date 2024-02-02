<?php

namespace Modules\Plan\Http\Requests\MaterialType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255']
        ];
    }
}
