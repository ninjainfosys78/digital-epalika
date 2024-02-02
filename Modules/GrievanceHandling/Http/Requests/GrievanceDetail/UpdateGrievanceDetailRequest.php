<?php

namespace Modules\GrievanceHandling\Http\Requests\GrievanceDetail;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGrievanceDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
