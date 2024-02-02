<?php

namespace Modules\Plan\Http\Requests\PlanLevel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePlanLevelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'plan_level_id' => ['nullable', Rule::exists('plan_levels', 'id')->withoutTrashed()],
            'level_name' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [
            'level_name.required' => 'योजना स्तर आवश्यक छ'
        ];
    }
}
