<?php

namespace Modules\GrievanceHandling\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\GrievanceHandling\Enums\GrievanceComplaintSeverity;

class StoreGrievanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'grievance_type_id' => ['required', Rule::exists('grievance_types', 'id')->withoutTrashed()],
            'description' => ['required'],
            'branch_id' => ['required', Rule::exists('branches', 'id')->withoutTrashed()],
            'complaint_severity' => ['required', new Enum(GrievanceComplaintSeverity::class)],
            'subject' => ['required'],
            'is_anonymous' => ['required'],
            'files' => ['nullable', 'array'],
            'files.*' => ['file']
        ];
    }
}
