<?php

namespace Modules\Recommendation\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('recommendation_edit');
    }

    public function rules(): array
    {
        $data = [
            'date_ne' => ['required'],
            'date_en' => ['required'],
            'recommendation_data' => ['required'],
            'personal_detail_id' => ['nullable', Rule::exists('personal_details', 'id')->withoutTrashed()],
            'files' => ['nullable', 'array'],
            'files.*.file_name' => ['nullable', 'string'],
            'files.*.file' => ['nullable', 'file'],
        ];

        if (auth()->user()->role->type === 'Super') {
            $data = array_merge($data, [
                'ward_no' => ['required', 'integer'],
            ]);
        }
        return $data;
    }
}
