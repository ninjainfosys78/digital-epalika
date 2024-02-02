<?php

namespace Modules\Recommendation\Http\Requests\PersonalDetail;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StorePersonalDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('personalDetail_create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'phone_no' => ['nullable', 'string'],
            'is_minor' => ['nullable', 'boolean'],
            'citizenship_no' => ['required', 'string'],
            'gender' => ['required', new Enum(Gender::class)],
            'province_id' => ['required', Rule::exists('provinces', 'id')->withoutTrashed()],
            'district_id' => ['required', Rule::exists('districts', 'id')->withoutTrashed()],
            'local_body_id' => ['required', Rule::exists('local_bodies', 'id')->withoutTrashed()],
            'ward_no' => ['required', 'integer'],
            'tole' => ['required', 'string']
        ];
    }
}
