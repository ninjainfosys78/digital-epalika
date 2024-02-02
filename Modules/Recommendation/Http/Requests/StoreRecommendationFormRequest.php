<?php

namespace Modules\Recommendation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecommendationFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'data' => ['required'],
        ];
    }
}
