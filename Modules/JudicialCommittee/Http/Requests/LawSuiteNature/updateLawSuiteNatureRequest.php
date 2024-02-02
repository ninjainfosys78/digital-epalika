<?php

namespace Modules\JudicialCommittee\Http\Requests\LawSuiteNature;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class updateLawSuiteNatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('lawsuitNature_create');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'code' => ['required'],
        ];
    }


    public function messages(): array
    {
        return [
            'title.required' => ['शीर्षक आवश्यक छ'],
            'code.required' => ['कोड आवश्यक छ']
        ];
    }
}
