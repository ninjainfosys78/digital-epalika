<?php

namespace Modules\Recommendation\Http\Requests\SipharisFormType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSipharisFormTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'sipharis_sub_category_id' => ['required', Rule::exists('sipharis_sub_categories', 'id')->withoutTrashed()],
            'sipharis_category_id' => ['required', Rule::exists('sipharis_categories', 'id')->withoutTrashed()],
            'title' => ['required'],
            'status' => ['required', 'boolean'],
            'need_approval' => ['required', 'boolean'],
            'fields' => ['required', 'array'],
            'fields.*.field_name' => ['required', 'max:255'],
            'fields.*.id' => ['nullable', Rule::exists('sipharis_form_fields' . 'id')->withoutTrashed()],
            'fields.*.slug' => ['nullable'],

        ];
    }

    /* public function rules(): array
     {
         switch ($this->method()) {
             case 'GET':
                 return [];
                 break;
             case 'PUT':
                 return [
                     'sipharis_sub_category_id'       => 'required',
                     'title'                          => 'required',
                     'content'                        => 'required',
                     'need_approval'                  => 'required',
                     'status'                         => 'required',
                     'field'                          => ['required', 'array'],
                 ];
             default:
                 return [
                     'sipharis_sub_category_id'       => 'required',
                     'title'                          => 'required',
                     'content'                        => 'required',
                     'need_approval'                  => 'required',
                     'status'                         => 'required',
                     'field' => ['required', 'array'],
                 ];
                 break;
         }
     }*/
}
