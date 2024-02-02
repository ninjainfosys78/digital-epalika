<?php

namespace Modules\BusinessRegistration\Http\Requests\BusinessRegistrationTemplate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateBusinessRegistrationTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('businessRegistrationTemplate_edit');
    }

    public function rules(): array
    {
        return [
            'title' => ['required'],
            'data' => ['required'],
        ];
    }
}
