<?php

namespace Modules\Grant\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('group_create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'g_registration_date' => ['required', 'date'],
            'registered_office' => ['required'],
            'monthly_meeting' => ['nullable'],
            'vat_pan' => ['nullable'],
            'province_id' => ['required', Rule::exists('provinces', 'id')->withoutTrashed()],
            'district_id' => ['required', Rule::exists('districts', 'id')->withoutTrashed()],
            'local_body_id' => ['required', Rule::exists('local_bodies', 'id')->withoutTrashed()],
            'ward_no' => ['required', 'integer'],
            'village' => ['nullable'],
            'tole' => ['nullable'],
            'farmers' => ['nullable', 'array'],
            'farmers.*' => [Rule::exists('farmers', 'id')->withoutTrashed()],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'नाम आवश्यक छ ।',
            'registration_date.required' => 'दर्ता मिति आवश्यक छ ।',
            'registered_office.required' => 'दर्ता भएको संगठन आवश्यक छ ।',
            'province_id.required' => 'प्रदेश आवश्यक छ ।',
            'district_id.required' => 'जिल्ला आवश्यक छ ।',
            'local_body_required' => 'पालिका आवश्यक छ ।',
            'ward_no.required' => 'वार्ड नं. आवश्यक छ ।'
        ];
    }
}
