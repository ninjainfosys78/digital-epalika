<?php

namespace Modules\Grant\Http\Requests\Setting\HelplessnessType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHelplessnessType extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'helplessness_type' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'helplessness_type.required' => 'असहायताको प्रकार नाम आवश्यक छ'
        ];
    }
}
