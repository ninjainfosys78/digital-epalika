<?php

namespace Modules\EMap\Http\Requests\CriteriaDetailSetting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\EMap\Enums\SignEnum;

class UpdateCriteriaDetailSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'land_use_area_id' => ['required', Rule::exists('land_use_areas', 'id')->withoutTrashed()],
            'title' => ['required', 'string'],
            'area' => ['required', 'numeric'],
            'sign' => ['required', new Enum(SignEnum::class)],
            'gcr' => ['required', 'numeric'],
            'far' => ['required', 'numeric'],
        ];
    }
}
