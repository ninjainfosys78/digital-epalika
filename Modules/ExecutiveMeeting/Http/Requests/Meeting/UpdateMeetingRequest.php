<?php

namespace Modules\ExecutiveMeeting\Http\Requests\Meeting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateMeetingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('meeting_edit');
    }

    public function rules(): array
    {
        return [
            'committee_id' => ['required', Rule::exists('committees', 'id')->withoutTrashed()],
            'meeting_name' => ['required'],
            'start_date' => ['required'],
            'en_start_date' => ['nullable', 'date'],
            'end_date' => ['required'],
            'en_end_date' => ['nullable', 'date'],
            'recurrence_end_date' => ['nullable'],
            'en_recurrence_end_date' => ['nullable', 'date'],
            'description' => ['required'],
        ];
    }
}
