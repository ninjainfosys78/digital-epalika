<?php

namespace Modules\Plan\Http\Requests\Labour;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLabourRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'unit_id' => ['required', 'integer', 'exists:units,id']
        ];
    }
}
