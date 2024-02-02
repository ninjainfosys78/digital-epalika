<?php

namespace Modules\Circular\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('digitalBoardNews_edit');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'date' => ['nullable'],
            'description' => ['nullable'],
        ];
    }
}
