<?php

namespace Modules\JudicialCommittee\Http\Requests\WrittenAnswer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateWrittenAnswerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('writtenAnswer_edit');
    }

    public function rules(): array
    {
        return [
            'description' => ['required'],
            'submitted_date' => ['required'],
            'files' => ['nullable', 'array'],
            'files.*' => ['mimes:jpg,png,jpeg,pdf'],
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'विवरण आवश्यक छ',
            'submitted_date.required' => 'पेश मिति आवश्यक छ',
        ];
    }
}
