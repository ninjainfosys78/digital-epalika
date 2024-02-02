<?php

namespace Modules\ExecutiveMeeting\Http\Requests\MeetingAgenda;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreMeetingAgendaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('meetingAgenda_create');
    }

    public function rules(): array
    {
        return [
            'proposal' => ['required', 'string', 'max:255'],
            'description' => ['nullable']
        ];
    }
}
