<?php

namespace Modules\BusinessRegistration\Http\Requests\PrintedData;

use Illuminate\Foundation\Http\FormRequest;

class StorePrintedDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'data' => ['required'],
            'files' => ['nullable', 'array'],
            'files.*' => ['mimes:jpg,png,jpeg,pdf'],
        ];
    }
}
