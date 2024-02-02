<?php

namespace Modules\GrievanceHandling\Http\Requests\GrievanceDetail;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\GrievanceHandling\Enums\GrievanceComplaintSeverity;
use Modules\GrievanceHandling\Enums\GrievanceMediumEnum;

class StoreGrievanceDetailRequest extends FormRequest
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
            'files' => ['nullable', 'array'],
            'files.*' => ['mimes:jpg,png,jpeg,pdf'],
            'branch_id' => ['required', Rule::exists('branches', 'id')->withoutTrashed()],
            'assigned_user_id' => ['nullable', Rule::exists('users', 'id')->withoutTrashed()],
            'complaint_severity' => ['required', new Enum(GrievanceComplaintSeverity::class)],
            'subject' => ['required', 'string', 'max:255'],
            'is_open' => ['nullable', 'boolean'],
            'grievance_medium' => ['required', new Enum(GrievanceMediumEnum::class)],
            'grievance_user_id' => ['required', Rule::exists('grievance_users', 'id')->withoutTrashed()]
        ];
    }
}
