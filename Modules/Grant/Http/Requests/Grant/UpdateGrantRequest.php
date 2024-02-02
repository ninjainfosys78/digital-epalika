<?php

namespace Modules\Grant\Http\Requests\Grant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\Grant\Enums\GranteeEnum;

class UpdateGrantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('grant_edit');
    }

    public function rules(): array
    {
        return [
            'fiscal_year_id' => ['required', Rule::exists('fiscal_years', 'id')->withoutTrashed()],
            'grant_type_id' => ['required', Rule::exists('grant_types', 'id')->withoutTrashed()],
            'grant_office_id' => ['required', Rule::exists('grant_offices', 'id')->withoutTrashed()],
            'grant_program_name' => ['required','string','max:255'],
            'branch_id' => ['required', Rule::exists('branches', 'id')->withoutTrashed()],
            'grant_amount' => ['required', 'numeric'],
            'grant_for' => ['required','array'],
            'grant_for.*' => ['required',new Enum(GranteeEnum::class)],
            'main_activity' => ['nullable'],
            'remarks' => ['nullable'],
        ];
    }
    public function messages()
    {
        return [
            'fiscal_year_id.required' => 'आर्थिक वर्ष आवश्यक छ ।',
            'grant_type_id.required' => 'अनुदान प्रकार आवश्यक छ ।',
            'grant_office_id.required' => 'अनुदान दिने सस्था आवश्यक छ ।',
            'grant_program_name.required' => 'अनुदानको कार्यक्रमको नाम आवश्यक छ ।',
            'branch_id.required' => 'शाखा आवश्यक छ ।',
            'grant_amount.required' => 'अनुदानको रकम आवश्यक छ ।',
            'grant_amount.numeric' => 'अनुदानको रकम नम्वरमा हुनुपर्छ।',
            'grant_for.required' => 'अनुदानग्राहीको प्रकार आवश्यक छ ।',
        ];
    }
}
