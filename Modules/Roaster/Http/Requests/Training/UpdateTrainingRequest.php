<?php

namespace Modules\Roaster\Http\Requests\Training;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTrainingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'open_date' => ['required'],
            'closed_date' => ['required'],
            'trainee_open_date' => ['required'],
            'trainee_closed_date' => ['required'],
            'organization_open_date' => ['required'],
            'organization_closed_date' => ['required'],
            'fiscal_year_id' => ['required', Rule::exists('fiscal_years', 'id')],
            'trainers' => ['nullable', 'array'],
            'trainers.*' => [Rule::exists('trainers', 'id')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'तालिमको नाम अनिवार्य छ',
            'fiscal_year_id.required' => 'आर्थिक वर्ष अनिवार्य छ',
            'closed_date.required' => 'वन्द मिति अनिवार्य छ',
            'open_date.required' => 'खुल्ने मिति अनिवार्य छ',
        ];
    }
}
