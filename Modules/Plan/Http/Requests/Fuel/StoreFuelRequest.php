<?php

namespace Modules\Plan\Http\Requests\Fuel;

use Illuminate\Foundation\Http\FormRequest;

class StoreFuelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'unit_id' => ['required'],
        ];
    }
}
