<?php

namespace Modules\JudicialCommittee\Http\Requests\DefendantIssuedDeadline;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateDefendantIssuedDeadlineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('defendantIssuedDeadline_edit');
    }

    public function rules(): array
    {
        return [
            'day_to_attend' => ['required', 'integer'],
            'submitted_date' => ['required']
        ];
    }

    protected array $messages = [
        'day_to_attend.required' => 'सहभागी हुनुपर्ने दिन आवश्यक छ',
        'submitted_date.required' => 'पेश गरिएको मिति आवश्यक छ'
    ];
}
