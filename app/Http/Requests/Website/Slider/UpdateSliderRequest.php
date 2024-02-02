<?php

namespace App\Http\Requests\Website\Slider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateSliderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('slider_edit');
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image'],
            'description' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'फोटो आवश्यक छ ',
            'image.image' => 'फोटो फर्ममा हुनुपर्छ ',
        ];
    }
}
