<?php

namespace Modules\BusinessRegistration\Http\Requests\BusinessNature;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateBusinessNature extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('businessNature_edit');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', Rule::unique('business_natures', 'title')->withoutTrashed()->ignore($this->businessNature)],
        ];
    }
}
