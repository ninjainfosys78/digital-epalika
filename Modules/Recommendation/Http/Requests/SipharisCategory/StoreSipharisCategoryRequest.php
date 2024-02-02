<?php

namespace Modules\Recommendation\Http\Requests\SipharisCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreSipharisCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('recommendationCategory_create');
        ;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            //'status'=>['required',Rule::in(['active', 'inactive'])]
        ];
    }
}
