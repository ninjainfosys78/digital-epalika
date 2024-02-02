<?php

namespace Modules\JudicialCommittee\Http\Requests\DateSheet;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreDateSheetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('dateSheet_create');
    }

    public function rules(): array
    {
        return [
            'year' => ['required'],
            'case_name' => ['required'],
            'appearance_date' => ['required'],
            'appearance_time' => ['required'],
            'submitted_date' => ['required']
        ];
    }
}
