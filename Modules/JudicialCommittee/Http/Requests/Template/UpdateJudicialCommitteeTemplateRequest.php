<?php

namespace Modules\JudicialCommittee\Http\Requests\Template;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJudicialCommitteeTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', Rule::unique('judicial_committee_templates', 'type')->withoutTrashed()->ignore($this->judicialCommitteeTemplate)],
            'title' => ['required', Rule::unique('judicial_committee_templates', 'title')->withoutTrashed()->ignore($this->judicialCommitteeTemplate)],
            'data' => ['required']
        ];
    }
}
