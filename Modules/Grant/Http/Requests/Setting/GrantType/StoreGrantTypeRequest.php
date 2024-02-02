<?php

namespace Modules\Grant\Http\Requests\Setting\GrantType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreGrantTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('grantType_create');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255']
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'अनुदान प्रकार आवश्यक छ ।',

        ];
    }
}
