<?php

namespace Modules\ExecutiveMeeting\Http\Requests\Setting\Committee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateCommitteeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('committee_edit');
    }

    public function rules(): array
    {
        return [
            'committee_type_id' => ['required', Rule::exists('committee_types', 'id')->withoutTrashed()],
            'committee_name' => ['required', 'string', 'max:255']
        ];
    }
}
