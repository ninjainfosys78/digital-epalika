<?php

namespace Modules\Identity\Http\Requests\DisabilityIdentityCard;

use App\Enums\BloodGroupEnum;
use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\BusinessRegistration\Enums\Qualification;

class UpdateDisabilityIdentityCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $basicValidations = [
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

        $fullDetailValidations = [
            "fullDetail.disability_reason_id" => ['required', Rule::exists('disability_reasons', 'id')->withoutTrashed()],
            "fullDetail.citizenship_no_place" => ['nullable', 'string', 'max:255'],
            "fullDetail.citizenship_date_ad" => ['nullable'],
            "fullDetail.citizenship_date" => ['nulable'],
            "fullDetail.document_photo" => ['nullable', 'file', 'mimes:jpeg,jpg,png'],
            "fullDetail.document_photo_back" => ['nullable', 'file', 'mimes:jpeg,jpg,png'],
            "fullDetail.material_description" => ['required'],
            "fullDetail.qualification" => ['required', new Enum(Qualification::class)],
            "fullDetail.blood_group" => ['required', new Enum(BloodGroupEnum::class)],
            "fullDetail.daily_activity" => ['required'],
            "fullDetail.supporting_material" => ['required'],
            "fullDetail.helping_task" => ['nullable', 'array'],
            "fullDetail.helping_task.*" => ['required', 'string'],
            "fullDetail.without_helping_task" => ['nullable', 'array'],
            "fullDetail.without_helping_task.*" => ['required', 'string'],
            "fullDetail.main_training_name" => ['nullable', 'string', 'max:255'],
            "fullDetail.occupation_id" => ['nullable', Rule::exists('occupations', 'id')->withoutTrashed()],
        ];

        return $this->is_full_detail_required == 1
            ? array_merge($basicValidations, $fullDetailValidations)
            : $basicValidations;
    }
}
