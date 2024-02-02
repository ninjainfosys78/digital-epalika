<?php

namespace Modules\Plan\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\Plan\Enums\ProjectStatusEnum;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'registration_no' => ['required', Rule::unique('projects', 'registration_no')->withoutTrashed()->ignore($this->project)],
            'project_name' => ['required'],
            'expense_head_id' => ['required', Rule::exists('expense_heads', 'id')->withoutTrashed()],
            'plan_area_id' => ['required', Rule::exists('plan_areas', 'id')->withoutTrashed()],
            'project_status' => ['required', new Enum(ProjectStatusEnum::class)],
            'plan_level_id' => ['required', Rule::exists('plan_levels', 'id')->withoutTrashed()],
            'ward_no' => ['nullable', 'array'],
            'ward_no.*' => ['integer'],
            'projectAllocatedAmounts' => ['required', 'array'],
            'projectAllocatedAmounts.*.budget_head_id' => ['required', Rule::exists('budget_heads', 'id')->withoutTrashed()],
            'projectAllocatedAmounts.*.amount' => ['required', 'numeric'],
            'project_venue' => ['nullable'],
            'purpose' => ['nullable'],
            'first_quarterly_amount' => ['nullable', 'numeric'],
            'first_quarterly_goal' => ['nullable', 'numeric'],
            'second_quarterly_amount' => ['nullable', 'numeric'],
            'second_quarterly_goal' => ['nullable', 'numeric'],
            'third_quarterly_amount' => ['nullable', 'numeric'],
            'third_quarterly_goal' => ['nullable', 'numeric'],
        ];
    }
}
