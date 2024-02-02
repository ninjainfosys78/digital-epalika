<?php

namespace Modules\JudicialCommittee\Http\Requests\DateCompensation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreDateCompensationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('dateCompensation_create');
    }

    public function rules(): array
    {
        return [
            'decision_date' => ['required'],
            'decision_subject' => ['required'],
            'decision_time' => ['required'],
            'submitted_date' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'decision_date.required' => 'निर्णय हुने मिति आवश्यक छ',
            'decision_subject.required' => 'निर्णय हुने विषय आवश्यक छ',
            'decision_time.required' => 'निर्णय हुने समय आवश्यक छ',
            'submitted_date.required' => 'पेश गरिएको मिति आवश्यक छ',
        ];
    }
}
