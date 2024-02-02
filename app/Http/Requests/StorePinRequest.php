<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pin' => ['required', 'integer']
        ];
    }

    public function messages(): array
    {
        return [
            'pin.required' => 'पिन आवश्यक छ !'
        ];
    }
}
