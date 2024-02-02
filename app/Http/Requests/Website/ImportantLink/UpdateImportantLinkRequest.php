<?php

namespace App\Http\Requests\Website\ImportantLink;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateImportantLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('importantLink_edit');
    }

    public function rules(): array
    {
        return [
            'link_title' => ['required', 'string', 'max:255'],
            'link_url' => ['required', 'url'],
        ];
    }

    public function messages()
    {
        return [
            'link_title.required' => 'शीर्षक आवश्यक छ',
            'link_url.required' => 'url आवश्यक छ',
            'link_url.url' => 'url फर्ममा हुनुपर्छ ',
        ];
    }
}
