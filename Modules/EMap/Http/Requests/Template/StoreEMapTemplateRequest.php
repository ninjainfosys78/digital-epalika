<?php

namespace Modules\EMap\Http\Requests\Template;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreEMapTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('eMapTemplate_create');
    }

    public function rules(): array
    {
        return [
            'title' => ['required'],
            'data' => ['required'],
        ];
    }
}
