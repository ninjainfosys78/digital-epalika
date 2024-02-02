<?php

namespace Modules\Grant\Http\Requests\Farmer;

use App\Enums\Gender;
use App\Enums\MaritalStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateFarmerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('farmer_create');
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image'],
            'gender' => ['required', new Enum(Gender::class)],
            'marital_status' => ['required', new Enum(MaritalStatusEnum::class)],
            'spouse_name' => ['required_if:marital_status,married'],
            'father_name' => ['required', 'string', 'max:255'],
            'grandfather_name' => ['required', 'string', 'max:255'],
            'citizenship_no' => ['required', Rule::unique('farmers', 'citizenship_no')->withoutTrashed()->ignore($this->farmer)],
            'farmer_id_card_no' => ['nullable', Rule::unique('farmers', 'farmer_id_card_no')->withoutTrashed()->ignore($this->farmer)],
            'national_id_card_no' => ['nullable', Rule::unique('farmers', 'national_id_card_no')->withoutTrashed()->ignore($this->farmer)],
            'phone_no' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:10'],
            'province_id' => ['required', Rule::exists('provinces', 'id')],
            'district_id' => ['required', Rule::exists('districts', 'id')],
            'local_body_id' => ['required', Rule::exists('local_bodies', 'id')],
            'ward_no' => ['required', 'integer'],
            'village' => ['nullable'],
            'tole' => ['nullable'],
            'groups' => ['nullable', 'array'],
            'groups.*' => [Rule::exists('groups', 'id')->withoutTrashed()],
            'enterprises' => ['nullable', 'array'],
            'enterprises.*' => [Rule::exists('enterprises', 'id')->withoutTrashed()],
            'cooperatives' => ['nullable', 'array'],
            'cooperatives.*' => [Rule::exists('cooperatives', 'id')->withoutTrashed()],
            'farmer_id' => ['nullable', Rule::exists('farmers', 'id')->whereNull('farmer_id')->withoutTrashed()],
            'relationship_id' => ['nullable', Rule::exists('relationships', 'id')->withoutTrashed()],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'नाम आवश्यक छ ।',
            'last_name.required' => 'थर आवश्यक छ ।',
            'gender.required' => 'लिङ्ग आवश्यक छ ।',
            'marital_status.required' => 'वैवाहिक स्थिति आवश्यक छ ।',
            'spouse_name.required' => 'श्रीमान/श्रीमती को नाम आवश्यक छ ।',
            'father_name.required' => 'वुवाको नाम आवश्यक छ ।',
            'grandfather_name.required' => 'हजुरवुवाको नाम आवश्यक छ ।',
            'citizenship_no.required' => 'नागरिता नं. आवश्यक छ ।',
            'phone_no.required' => 'सम्पर्क नं. आवश्यक छ ।',
            'phone_no.regex' => 'सम्पर्क अंग्रेजी नं मा हुनुपर्छ।',
            'phone_no.min' => 'सम्पर्क नं ९ अंक भन्दा धेरै हुनुपर्छ।',
            'province_id.required' => 'प्रदेश आवश्यक छ ।',
            'district_id.required' => 'जिल्ला आवश्यक छ ।',
            'local_body_required' => 'पालिका आवश्यक छ ।',
            'ward_no.required' => 'वार्ड नं. आवश्यक छ ।'
        ];
    }
}
