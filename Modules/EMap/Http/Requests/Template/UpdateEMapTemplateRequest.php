<?php

namespace Modules\EMap\Http\Requests\Template;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateEMapTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('eMapTemplate_edit');
    }

    public function rules(): array
    {
        return [
            'title' => ['required'],
            'data' => ['required'],
        ];
    }
}
