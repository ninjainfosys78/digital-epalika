<?php

namespace App\Http\Requests\Website\MunicipalDetail;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateMunicipalDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('municipalDetail_edit');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['required'],
            'count' => ['required'],
            'bg_color' => ['required'],
            'position' => ['nullable', 'integer'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'शिर्षक अनिबार्य छ ',
            'icon.required' => 'आइकन अनिबार्य छ ',
            'count.required' => 'गणना अनिबार्य छ ',
            'bg_color.required' => 'कलर अनिबार्य छ ',
            'position.integer' => 'स्थिति अङ्कमा हुनुपर्छ ',
        ];
    }
}
