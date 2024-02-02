<?php

namespace Modules\EMap\Http\Requests\Renewed;

use Illuminate\Foundation\Http\FormRequest;

class StoreRenewedRequest extends FormRequest
{
    public function authorize():bool
    {
        return true;
    }

    public function rules():array
    {
        return [
            'year' => ['required'],
            'document' => ['required', 'mimes:png,jpg,jpeg'],
        ];
    }
}
