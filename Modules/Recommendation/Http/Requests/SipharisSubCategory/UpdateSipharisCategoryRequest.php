<?php

namespace Modules\Recommendation\Http\Requests\SipharisSubCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSipharisCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'sipharis_category_id' => ['required']
            //'status'=>['required',Rule::in(['active', 'inactive'])]
        ];
    }
}
