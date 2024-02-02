<?php

namespace Modules\Recommendation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateRecommendationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('recommendation_edit');
    }

    public function rules(): array
    {
        return [
            'date_ne' => ['required'],
            'date_en' => ['required'],
            'name' => ['required'],
            'state' => ['nullable'],
            'submissionValues' => ['required', 'json'],
        ];
    }
}
