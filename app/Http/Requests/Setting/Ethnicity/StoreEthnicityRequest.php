<?php

namespace App\Http\Requests\Setting\Ethnicity;

use Illuminate\Foundation\Http\FormRequest;

class StoreEthnicityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => ['जातियता आवश्यक छ'],
        ];
    }
}
