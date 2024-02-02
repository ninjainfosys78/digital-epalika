<?php

namespace Modules\ExecutiveMeeting\Http\Requests\MeetingDecision;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateMeetingDecisionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('meetingDecision_edit');
    }

    public function rules(): array
    {
        return [
            'date' => ['required'],
            'en_date' => ['required', 'date'],
            'description' => ['required'],
            'chairman' => ['required', 'string', 'max:255'],
        ];
    }
}
