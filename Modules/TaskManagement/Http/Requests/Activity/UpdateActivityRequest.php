<?php

namespace Modules\TaskManagement\Http\Requests\Activity;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('taskActivity_edit');
    }

    public function rules(): array
    {
        return [
            'date' => ['required'],
            'date_en' => ['required'],
            'activity_lists' => ['required', 'array'],
            'activity_lists.*.id' => ['nullable',Rule::exists('activity_lists', 'id')],
            'activity_lists.*.title' => ['required', 'string', 'max:255'],
            'activity_lists.*.description' => ['nullable'],
            'activity_lists.*.remarks' => ['nullable'],
            'activity_lists.*.documents' => ['nullable', 'array'],
            'activity_lists.*.documents.*' => ['mimes:jpg,png,jpeg,pdf'],
            'remarks' => ['nullable']
        ];
    }
}
