<?php

namespace Modules\Revenue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePlaceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sector_id' => ['required', Rule::exists('sectors', 'id')->withoutTrashed()],
            'title' => ['required', 'string', 'max:255'],
            'ward_no' => ['required', 'array'],
            'ward_no.*' => ['integer'],
            'rate' => ['required', 'numeric'],
        ];
    }
}
