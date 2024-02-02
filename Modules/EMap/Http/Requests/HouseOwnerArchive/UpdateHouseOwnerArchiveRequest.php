<?php

namespace Modules\EMap\Http\Requests\HouseOwnerArchive;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHouseOwnerArchiveRequest extends FormRequest
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
