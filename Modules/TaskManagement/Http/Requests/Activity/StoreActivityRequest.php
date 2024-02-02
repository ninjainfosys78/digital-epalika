<?php

namespace Modules\TaskManagement\Http\Requests\Activity;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('taskActivity_create');
    }

    public function rules(): array
    {
        return [
            'date' => ['required'],
            'date_en' => ['required','date'],
            'activity_lists' => ['required', 'array'],
            'activity_lists.*.title' => ['required', 'string', 'max:255'],
            'activity_lists.*.description' => ['nullable'],
            'activity_lists.*.remarks' => ['nullable'],
            'activity_lists.*.documents' => ['nullable', 'array'],
            'activity_lists.*.documents.*' => ['mimes:jpg,png,jpeg,pdf'],
            'remarks' => ['nullable']
        ];
    }
}
