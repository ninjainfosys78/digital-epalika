<?php

namespace Modules\Identity\Http\Requests\DisabilityReason;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateDisabilityReasonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('disabilityReason_edit');
    }

    public function rules(): array
    {
        return [
            'title' => ['required','string','max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => ['शिर्षक आवश्यक छ'],
        ];
    }
}
