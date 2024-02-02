<?php

namespace Modules\DigitalBoard\Http\Requests\Audio;

use Illuminate\Foundation\Http\FormRequest;

class StoreAudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'audio' => ['required'],
        ];
    }
}
