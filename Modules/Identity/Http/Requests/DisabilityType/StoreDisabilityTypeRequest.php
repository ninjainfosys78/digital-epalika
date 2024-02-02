<?php

namespace Modules\Identity\Http\Requests\DisabilityType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreDisabilityTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('disabilityType_create');
    }

    public function rules(): array
    {
        return [
            'disability_type_id' => ['nullable', Rule::exists('disability_types', 'id')->withoutTrashed()],
            'title' => ['required','string','max:255'],
            'title_en' => ['required','string','max:255'],
        ];
    }
    public function messages(): array
    {
        return [
            'disability_type_id.required' => ['शिर्षक आवश्यक छ'],
            'title.required' => ['शिर्षक आवश्यक छ'],
            'title_en.required' => ['शिर्षक अंग्रेजीमा आवश्यक छ'],
        ];
    }
}
