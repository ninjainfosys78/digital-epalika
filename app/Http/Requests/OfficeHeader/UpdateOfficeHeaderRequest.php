<?php

namespace App\Http\Requests\OfficeHeader;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfficeHeaderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'font' => ['required'],
            'font_size' => ['required'],
            'position' => ['required', 'integer'],
            'font_color' => ['nullable'],
            'card_font' => ['nullable'],
        ];
    }
}
