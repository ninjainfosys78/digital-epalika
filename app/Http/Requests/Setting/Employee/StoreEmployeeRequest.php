<?php

namespace App\Http\Requests\Setting\Employee;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('employee_create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'department' => ['nullable', 'string'],
            'designation' => ['required', 'string'],
            'photo' => ['nullable', 'mimes:png,jpeg,jpg'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'position' => ['nullable', 'integer'],
            'status' => ['nullable', 'boolean'],
            'is_employee' => ['nullable', 'boolean'],
            'is_dept_head' => ['nullable', 'boolean'],
            'branch_id' => ['nullable', Rule::exists('branches', 'id')->withoutTrashed()],
            'employee_id' => ['nullable', Rule::exists('employees', 'id')->withoutTrashed()],
            'show_to_mobile_app' => ['nullable', 'boolean'],
            'show_to_index' => ['nullable', 'boolean'],
            'gender' => ['required', new Enum(Gender::class)],
            'dob' => ['nullable', 'date'],
            'dob_ad' => ['nullable', 'date'],
            'address' => ['nullable', 'string', 'max:255'],
            'ethnicity_id' => ['nullable'],
            'pan_no' => ['nullable'],
            'pis_no' => ['nullable'],
            'epf_no' => ['nullable'],
            'cif_no' => ['nullable'],
            'insurance_card_no' => ['nullable'],
            'description' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'नाम अनिवार्य छ।',
            'photo.mimes' => 'फोटो अनिवार्य jpg, jpeg, png मा छ। ',
            'email.unique' => 'इमेल पहिले नै अवस्थित छ।',
            'phone.unique' => 'फोन पहिले नै अवस्थित छ।',
            'position.integer' => 'Position पूर्णांक हुनुपर्छ',
        ];
    }
}
