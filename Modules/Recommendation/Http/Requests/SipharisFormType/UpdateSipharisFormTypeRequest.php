<?php

namespace Modules\Recommendation\Http\Requests\SipharisFormType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSipharisFormTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'sipharis_sub_category_id' => ['required', Rule::exists('sipharis_sub_categories', 'id')->withoutTrashed()],
            'title' => ['required'],
            'content' => ['required'],
            'need_approval' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
            'fields' => ['required', 'array'],
            'fields.*.field_name' => ['required', 'max:255'],
            'fields.*.status' => ['nullable', 'boolean'],

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
