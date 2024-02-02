<?php

namespace Modules\JudicialCommittee\Http\Requests\ComplaintSubject;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreComplaintSubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('complaintSubject_create');
    }

    public function rules(): array
    {
        return [
            'lawsuit_nature_id' => ['required', Rule::exists('lawsuit_natures', 'id')->withoutTrashed()],
            'subject' => ['required', 'string', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'lawsuit_nature_id.required' => 'मुद्दा प्रकृति आवश्यक छ',
            'subject.required' => 'विषय आवश्यक छ'
        ];
    }
}
