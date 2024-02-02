<?php

namespace Modules\BusinessRegistration\Http\Requests\BusinessPurpose;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreBusinessPurposeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('businessPurpose_create');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
        ];
    }
}
