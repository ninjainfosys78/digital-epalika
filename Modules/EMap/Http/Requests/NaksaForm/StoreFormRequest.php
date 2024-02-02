<?php

namespace Modules\EMap\Http\Requests\NaksaForm;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\EMap\Enums\EMapFormFillerTypeEnum;
use Modules\EMap\Enums\FormTypeEnum;

class StoreFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
            'form_type' => ['required', 'string', new Enum(FormTypeEnum::class)],
            'route_name' => [Rule::requiredIf(function () {
                return request('form_type') === FormTypeEnum::FORM->value;
            })],
            'map_pass_group_id' => ['required', Rule::exists('map_pass_groups', 'id')->withoutTrashed()],
            'need_from' => ['required', 'string', new Enum(EMapFormFillerTypeEnum::class)],
            'fields' => [Rule::requiredIf(function () {
                return request('form_type') === FormTypeEnum::FILE->value;
            }), 'array'],
            'fields.*.title' => ['nullable'],
            'fields.*.description' => ['nullable'],

        ];
    }
}
