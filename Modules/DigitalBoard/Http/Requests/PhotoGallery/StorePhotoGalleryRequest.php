<?php

namespace Modules\DigitalBoard\Http\Requests\PhotoGallery;

use Illuminate\Foundation\Http\FormRequest;

class StorePhotoGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required','string','max:255'],
            'image' => ['required','image','mimes:png,jpg,jpeg'],
            'caption' => ['required','string','max:255'],
        ];
    }
}
