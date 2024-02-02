<?php

namespace Modules\Plan\Http\Requests\PlanArea;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdatePlanAreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('planArea_edit');
    }

    public function rules(): array
    {
        return [
            'plan_area_id' => ['nullable', Rule::exists('plan_areas', 'id')->withoutTrashed()],
            'area_name' => ['required', Rule::unique('plan_areas', 'area_name')->withoutTrashed()->ignore($this->planArea)]
        ];
    }

    public function messages(): array
    {
        return [
            'area_name' => 'क्षेत्रको नाम आवश्यक छ'
        ];
    }
}
