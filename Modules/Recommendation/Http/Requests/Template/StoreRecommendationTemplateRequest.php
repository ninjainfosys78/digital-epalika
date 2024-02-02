<?php

namespace Modules\Recommendation\Http\Requests\Template;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreRecommendationTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('recommendationTemplate_create');
    }

    public function rules(): array
    {
        return [
            'data' => ['required'],
            'title' => ['required','string']
        ];
    }
}
