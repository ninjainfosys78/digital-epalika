<?php

namespace Modules\Recommendation\Http\Requests\Template;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateRecommendationTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('recommendationTemplate_edit');
    }

    public function rules(): array
    {
        return [
            'data' => ['required'],
            'title' => ['required','string'],
        ];
    }
}
