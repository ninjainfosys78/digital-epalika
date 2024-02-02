<?php

namespace Modules\Recommendation\Http\Requests\RecommendationCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateRecommendationCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('recommendationCategory_edit');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'recommendation_category_id' => ['nullable',Rule::exists('recommendation_categories', 'id')->withoutTrashed()],
        ];
    }
}
