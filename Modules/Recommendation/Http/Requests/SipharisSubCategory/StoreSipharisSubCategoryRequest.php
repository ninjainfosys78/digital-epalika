<?php

namespace Modules\Recommendation\Http\Requests\SipharisSubCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSipharisSubCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'sipharis_category_id' => ['required', Rule::exists('sipharis_categories', 'id')->withoutTrashed()]
            //'status'=>['required',Rule::in(['active', 'inactive'])]
        ];
    }
}
