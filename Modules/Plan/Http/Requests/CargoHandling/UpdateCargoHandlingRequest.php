<?php

namespace Modules\Plan\Http\Requests\CargoHandling;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCargoHandlingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
