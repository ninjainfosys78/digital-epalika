<?php

namespace Modules\BusinessRegistration\Http\Requests\BusinessNature;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreBusinessNature extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('businessNature_create');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', Rule::unique('business_natures', 'title')->withoutTrashed()],
        ];
    }
}
