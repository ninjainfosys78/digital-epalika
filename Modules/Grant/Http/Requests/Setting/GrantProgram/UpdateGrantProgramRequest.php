<?php

namespace Modules\Grant\Http\Requests\Setting\GrantProgram;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateGrantProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('grantProgram_edit');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255']
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'अनुदान कार्यक्रम आवश्यक छ'
        ];
    }
}
