<?php

namespace Modules\JudicialCommittee\Http\Requests\Template;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\JudicialCommittee\Enums\JudicialTemplateTypeEnum;

class StoreJudicialCommitteeTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', new Enum(JudicialTemplateTypeEnum::class), Rule::unique('judicial_committee_templates', 'type')->withoutTrashed()],
            'title' => ['required', Rule::unique('judicial_committee_templates', 'title')->withoutTrashed()],
            'data' => ['required']
        ];
    }
}
