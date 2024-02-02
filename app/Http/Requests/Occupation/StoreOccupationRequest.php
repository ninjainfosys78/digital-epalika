<?php

namespace App\Http\Requests\Occupation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreOccupationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('occupation_create');
    }

    public function rules(): array
    {
        return [
            'title' => ['required','string','max:255']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'पेसा आवश्यक छ',
        ];
    }
}
