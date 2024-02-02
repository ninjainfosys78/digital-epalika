<?php

namespace Modules\Recommendation\Http\Requests\SignatureDetail;

use Illuminate\Foundation\Http\FormRequest;

class StoreSignatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string'],
            'position' => ['required', 'string'],
            'signature' => ['required', 'image']
        ];
    }
}
