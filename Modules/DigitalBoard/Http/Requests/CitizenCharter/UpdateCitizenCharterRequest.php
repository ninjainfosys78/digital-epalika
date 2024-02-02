<?php

namespace Modules\DigitalBoard\Http\Requests\CitizenCharter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCitizenCharterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['required','string',Rule::exists('branches', 'id')],
            'service' => ['required','string'],
            'required_document' => ['nullable','string'],
            'amount' => ['required','string'],
            'time' => ['required','string'],
            'responsible_person' => ['required','string'],
        ];
    }
}
