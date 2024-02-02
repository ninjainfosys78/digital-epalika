<?php

namespace Modules\Revenue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStructureAssessmentRateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sector_id' => ['required', 'integer', Rule::exists('sectors', 'id')->withoutTrashed()],
            'physical_structure_type_id' => ['required', 'integer', Rule::exists('physical_structure_types', 'id')->withoutTrashed()],
            'usage' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'numeric', 'min:0']
        ];
    }
}
