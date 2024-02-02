<?php

namespace Modules\Revenue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePhysicalStructureTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', Rule::unique('physical_structure_types', 'title')->withoutTrashed()->ignore($this->physicalStructureType)],
        ];
    }
}
