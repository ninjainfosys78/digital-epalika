<?php

namespace Modules\Plan\Http\Requests\Template;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\Plan\Enums\PlanTemplateTypeEnum;
use Modules\Plan\Enums\ProjectOperatedThroughEnum;

class StorePlanTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['nullable',new Enum(PlanTemplateTypeEnum::class)],
            'template_for' => ['nullable', new Enum(ProjectOperatedThroughEnum::class)],
            'title' => ['required', Rule::unique('plan_templates', 'title')->withoutTrashed()],
            'data' => ['required']
        ];
    }
}
