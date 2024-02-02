<?php

namespace Modules\EMap\Http\Requests\MapFee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateMapFeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('mapFee_edit');
    }

    public function rules(): array
    {
        return [
            'storey' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'storey.required' => 'तल्ला आवश्यक छ',
            'rate.required' => 'दर आवश्यक छ',
            'rate.numeric' => 'दर संख्यात्मक हुनुपर्छ',
        ];
    }
}
