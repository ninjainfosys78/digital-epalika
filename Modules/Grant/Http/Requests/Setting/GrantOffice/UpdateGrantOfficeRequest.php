<?php

namespace Modules\Grant\Http\Requests\Setting\GrantOffice;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGrantOfficeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'office_name' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'office_name.required' => 'कार्यालयको नाम आवश्यक छ'
        ];
    }
}
