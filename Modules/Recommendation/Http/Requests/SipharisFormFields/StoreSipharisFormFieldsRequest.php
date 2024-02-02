<?php

namespace Modules\Recommendation\Http\Requests\SipharisFormFields;

use Illuminate\Foundation\Http\FormRequest;

class StoreSipharisFormFieldsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        switch ($this->method()) {
            case 'GET':
                return [];
                break;
            case 'PUT':
                return [
                    'files' => ['nullable', 'array'],
                    'files.*.file_name' => ['required', 'string'],
                    'field.*.file_name' => ['required', 'string'],
                ];
            default:
                return [
                    'files' => ['nullable', 'array'],
                    'files.*.field_name' => ['required', 'string'],
                    'files.*.file' => ['nullable', 'string'],
                ];
                break;
        }
    }
}
