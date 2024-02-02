<?php

namespace Modules\EMap\Http\Requests\MapPassGroup;

use Illuminate\Foundation\Http\FormRequest;

class StoreMapPassGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'users' => ['required', 'array'],
            'users.*.user_id' => ['required'],
            'users.*.ward_no' => ['required', 'array'],
        ];
    }
}
