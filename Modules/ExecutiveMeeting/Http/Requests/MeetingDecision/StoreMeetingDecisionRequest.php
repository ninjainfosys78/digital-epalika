<?php

namespace Modules\ExecutiveMeeting\Http\Requests\MeetingDecision;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreMeetingDecisionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('meetingDecision_create');
    }

    public function rules(): array
    {
        return [
            'date' => ['required'],
            'en_date' => ['required', 'date'],
            'description' => ['required'],
            'chairman' => ['required', 'string', 'max:255'],
            'meetingParticipants' => ['nullable', 'array'],
            'meetingParticipants.*' => [Rule::exists('committee_members', 'id')->withoutTrashed()],
            'invitedMember' => ['nullable', 'array'],
            'invitedMember.*.name' => ['nullable'],
            'invitedMember.*.designation' => ['nullable'],
            'invitedMember.*.phone' => ['nullable'],
            'invitedMember.*.email' => ['nullable', 'email'],
        ];
    }
}
