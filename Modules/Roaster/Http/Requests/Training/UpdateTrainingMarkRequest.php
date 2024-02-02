<?php

namespace Modules\Roaster\Http\Requests\Training;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrainingMarkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'aim' => ['nullable'],
            'description' => ['nullable'],
            'places' => ['nullable'],
            'pre_max_mark' => ['nullable', 'integer'],
            'pre_min_mark' => ['nullable', 'integer'],
            'pre_average_mark' => ['nullable', 'integer'],
            'post_max_mark' => ['nullable', 'integer'],
            'post_min_mark' => ['nullable', 'integer'],
            'post_average_mark' => ['nullable', 'integer'],
            'included_subjects' => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'तालिमको नाम अनिवार्य छ',
            'pre_max_mark.integer' => 'पुर्व अधिकतम अंक नम्बरमा हुनुपर्छ ',
            'pre_min_mark.integer' => 'पुर्व न्युनतम अंक नम्बरमा हुनुपर्छ ',
            'pre_average_mark.integer' => 'पुर्व औसत अंक नम्बरमा हुनुपर्छ ',
            'post_max_mark.integer' => 'पोस्ट अधिकतम अंक नम्बरमा हुनुपर्छ ',
            'post_min_mark.integer' => 'पोस्ट न्युनतम अंक नम्बरमा हुनुपर्छ',
            'post_average_mark.integer' => 'पोस्ट औसत अंक नम्बरमा हुनुपर्छ',
        ];
    }
}
