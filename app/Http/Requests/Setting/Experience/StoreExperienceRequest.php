<?php

namespace App\Http\Requests\Setting\Experience;

use Illuminate\Foundation\Http\FormRequest;

class StoreExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'office' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'responsibility' => ['required'],
            'remarks' => ['required'],
        ];
    }
}
