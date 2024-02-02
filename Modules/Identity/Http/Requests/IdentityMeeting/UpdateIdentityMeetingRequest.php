<?php

namespace Modules\Identity\Http\Requests\IdentityMeeting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateIdentityMeetingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'date_bs' => ['required'],
            'date_ad' => ['required', 'date'],
            'description' => ['nullable'],
            'committees' => ['required', 'array'],
            'committees.*' => [Rule::exists('disability_committees', 'id')->withoutTrashed()],
            'disabilityIdentityCards' => ['nullable', 'array'],
            'disabilityIdentityCards.*.id' => ['nullable', Rule::exists('disability_identity_cards', 'id')->withoutTrashed()],
            'disabilityIdentityCards.*.gov_disability_type_id' => ['required_with:disabilityIdentityCards.*.id'],
            "guests" => ['nullable', 'array'],
            "guests.*.name" => ['required'],
            "guests.*.phone" => ['nullable'],
            "guests.*.designation" => ['nullable'],
            "guests.*.id" => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'बैठकको शिर्षक आवश्यक छ',
            'title.date_bs' => 'बैठकको मिति आवश्यक छ',
            'disabilityIdentityCards.*.governmental_disability_type_id' => 'अपाङ्गताको प्रकार आवश्यक छ',
        ];
    }
}
