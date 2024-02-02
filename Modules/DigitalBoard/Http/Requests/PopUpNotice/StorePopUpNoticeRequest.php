<?php

namespace Modules\DigitalBoard\Http\Requests\PopUpNotice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePopUpNoticeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('digitalBoardNotice_create');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            'description' => ['nullable'],
            'closed_at' => ['nullable'],
            'show_on_index' => ['nullable', 'boolean'],
            //            'type'=>'Notice',
            //            'files' => ['required_if:type,Notice','nullable', 'array'],
            //            'files.*' => ['mimes:png,jpeg,jpg'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'शिर्षक अनिबार्य छ।',
            'date.required' => 'मिति अनिबार्य छ।',
        ];
    }
}
