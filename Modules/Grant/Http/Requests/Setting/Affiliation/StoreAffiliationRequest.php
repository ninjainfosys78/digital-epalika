<?php

namespace Modules\Grant\Http\Requests\Setting\Affiliation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreAffiliationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('affiliation_create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255']
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'आव्धता आवश्यक छ ।',

        ];
    }
}
