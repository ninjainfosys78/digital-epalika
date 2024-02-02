<?php

namespace App\Http\Requests\MobileUserDetail;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreMobileDetailUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'citizenship_no' => ['required'],
            'nec_no' => ['required'],
            'citizenship_issued_date' => ['required','date'],
            'mobile_user_id' => ['required', Rule::exists('mobile_users', 'id')->withoutTrashed()],
            'province_id' => ['required', Rule::exists('provinces', 'id')->withoutTrashed()],
            'district_id' => ['required', Rule::exists('districts', 'id')->withoutTrashed()],
            'local_body_id' => ['required', Rule::exists('local_bodies', 'id')->withoutTrashed()],
            'ward_no' => ['required','numeric'],
            'tole' => ['required','string'],
            'temporary_province_id' => ['required', Rule::exists('provinces', 'id')->withoutTrashed()],
            'temporary_district_id' => ['required', Rule::exists('districts', 'id')->withoutTrashed()],
            'temporary_local_body_id' => ['required', Rule::exists('local_bodies', 'id')->withoutTrashed()],
            'temporary_ward' => ['required','numeric'],
            'temporary_tole' => ['required','string'],
            'citizenship_front' => ['required','image', 'mimes:png,jpg,jpeg'],
            'nec_certificate' => ['required','image', 'mimes:png,jpg,jpeg'],
            'citizenship_back' => ['required','image', 'mimes:png,jpg,jpeg'],
            'nec_certificate' => ['nullable','image', 'mimes:png,jpg,jpeg'],
            'citizenship_issued_district' => ['required',Rule::exists('districts', 'id')->withoutTrashed()]

        ];
    }
}
