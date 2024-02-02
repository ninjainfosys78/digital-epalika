<?php

namespace Modules\GrievanceHandling\Http\Requests\GrievanceType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateGrievanceTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('grievanceType_edit');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', Rule::unique('grievance_types', 'title')->withoutTrashed()->ignore($this->grievanceType)],
        ];
    }
}
