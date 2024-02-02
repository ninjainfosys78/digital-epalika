<?php

namespace Modules\DigitalBoard\Http\Requests\ServiceEmployee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_name' => ['required'],
            'photo' => ['nullable', 'image'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable'],
            'designation' => ['required'],
            'position' => ['nullable', 'integer'],
        ];
    }

    public function messages()
    {
        return [
            'employee_name.required' => 'कर्मचारी नाम आबश्यक छ ',
            'photo.image' => 'फोटो फर्ममा हुनुपर्छ ',
            'email.email' => 'इमेल फर्ममा हुनुपर्छ ',
            'designation.required' => 'पद आबश्यक छ ',
            'position.integer' => 'स्थिति अन्कमा हुनुपर्छ ',
        ];
    }
}
