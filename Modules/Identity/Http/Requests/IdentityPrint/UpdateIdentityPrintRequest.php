<?php

namespace Modules\Identity\Http\Requests\IdentityPrint;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Gender;

class UpdateIdentityPrintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'photo' => ['nullable', 'mimes:jpeg,jpg,png'],
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'citizenship_no' => [
                'required_if:birth_registration_no,null',
                Rule::unique('disability_identity_cards', 'citizenship_no')
                    ->whereNotNull('citizenship_no')
                    ->withoutTrashed()
                    ->ignore($this->disabilityIdentityCard)
            ],
            'birth_registration_no' => [
                'required_if:citizenship_no,null',
                Rule::unique('disability_identity_cards', 'birth_registration_no')
                    ->whereNotNull('birth_registration_no')
                    ->withoutTrashed()
                    ->ignore($this->disabilityIdentityCard)
            ],
            'father_name' => ['nullable', 'string', 'max:255'],
            'father_name_en' => ['nullable', 'string', 'max:255'],
            'mother_name' => ['nullable', 'string', 'max:255'],
            'mother_name_en' => ['nullable', 'string', 'max:255'],
            'dob' => ['required'],
            'dob_ad' => ['required'],
            'gender' => ['required', new Enum(Gender::class)],
            'province_id' => ['required', Rule::exists('provinces', 'id')->withoutTrashed()],
            'gov_disability_type_id' => ['required', Rule::exists('governmental_disability_types', 'id')->withoutTrashed()],
            'district_id' => ['required', Rule::exists('districts', 'id')->withoutTrashed()],
            'local_body_id' => ['required', Rule::exists('local_bodies', 'id')->withoutTrashed()],
            'ward_no' => ['required', 'integer'],
            'tole' => ['required', 'string', 'max:255'],
            'disability_type_id' => ['required', Rule::exists('disability_types', 'id')->withoutTrashed()],
            'guardian_name' => ['required', 'string', 'max:255'],
            'guardian_name_en' => ['required', 'string', 'max:255'],
            'relationship_id' => ['required', Rule::exists('relationships', 'id')->withoutTrashed()],
            'phone' => ['required'],
            'is_full_detail_required' => ['nullable', 'boolean'],
        ];
    }
}
