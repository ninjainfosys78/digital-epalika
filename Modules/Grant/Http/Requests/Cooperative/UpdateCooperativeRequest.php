<?php

namespace Modules\Grant\Http\Requests\Cooperative;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCooperativeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'cooperative_type_id' => ['required', Rule::exists('cooperative_types', 'id')->withoutTrashed()],
            'registration_no' => ['required', Rule::unique('cooperatives', 'registration_no')->withoutTrashed()->ignore($this->cooperative)],
            'c_registration_date' => ['required'],
            'vat_pan' => ['nullable'],
            'objective' => ['nullable'],
            'affiliation_id' => ['nullable', Rule::exists('affiliations', 'id')->withoutTrashed()],
            'province_id' => ['required', Rule::exists('provinces', 'id')],
            'district_id' => ['required', Rule::exists('districts', 'id')],
            'local_body_id' => ['required', Rule::exists('local_bodies', 'id')],
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
            'name.required' => 'आव्धता आवश्यक छ ।',
            'cooperative_type_id.required' => 'सहकारीको प्रकार आवश्यक छ ।',
            'registration_no.required' => 'दर्ता नं. आवश्यक छ ।',
            'registration_date.required' => 'दर्ता मिति आवश्यक छ ।',
            'objective.required' => 'उदश्य आवश्यक छ ।',
            'province_id.required' => 'प्रदेश आवश्यक छ ।',
            'district_id.required' => 'जिल्ला आवश्यक छ ।',
            'local_body_required' => 'पालिका आवश्यक छ ।',
            'ward_no.required' => 'वार्ड नं. आवश्यक छ ।'
        ];
    }
}
