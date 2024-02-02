<?php

namespace App\Http\Requests\Setting\Relationship;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreRelationshipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('relationship_create');
    }

    public function rules(): array
    {
        return [
            'title' => ['required','string','max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => ['शिर्षक आवश्यक छ'],
        ];
    }
}
