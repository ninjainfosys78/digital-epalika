<?php

namespace Modules\ExecutiveMeeting\Http\Requests\Setting\CommitteeType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateCommitteeTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('committeeType_edit');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'committee_no' => ['nullable', 'numeric']
        ];
    }
}
