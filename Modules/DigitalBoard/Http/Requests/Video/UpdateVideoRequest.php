<?php

namespace Modules\DigitalBoard\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateVideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('digitalBoardVideo_edit');
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'video' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'video.mimes' => 'भिडियो mp4 मा छ ',
        ];
    }
}
