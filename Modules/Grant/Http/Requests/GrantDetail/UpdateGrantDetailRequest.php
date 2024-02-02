<?php

namespace Modules\Grant\Http\Requests\GrantDetail;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\Grant\Enums\NewOrContinueEnum;

class UpdateGrantDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'grant_program_id' => ['required', Rule::exists('grant_programs', 'id')->withoutTrashed()],
            'grant_type_id' => ['required', Rule::exists('grant_types', 'id')->withoutTrashed()],
            'local_body_id' => ['required', Rule::exists('local_bodies', 'id')->withoutTrashed()],
            'ward_no' => ['required', 'integer'],
            'village' => ['nullable'],
            'tole' => ['nullable'],
            'is_new' => ['required', new Enum(NewOrContinueEnum::class)],
            'unit_no' => ['required'],
            'phone' => ['required'],
            'investment' => ['nullable'],
            'remarks' => ['nullable']
        ];
    }
}
