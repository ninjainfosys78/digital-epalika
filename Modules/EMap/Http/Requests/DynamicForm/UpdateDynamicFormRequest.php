<?php

namespace Modules\EMap\Http\Requests\DynamicForm;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDynamicFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', Rule::unique('dynamic_forms', 'title')->ignore($this->dynamicForm)->withoutTrashed()],
            'fields' => ['required', 'json'],
        ];
    }
}
