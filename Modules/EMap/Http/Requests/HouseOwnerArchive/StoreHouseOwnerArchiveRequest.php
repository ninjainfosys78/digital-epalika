<?php

namespace Modules\EMap\Http\Requests\HouseOwnerArchive;

use Illuminate\Foundation\Http\FormRequest;

class StoreHouseOwnerArchiveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'phone' => ['required'],
            'father_name' => ['required'],
            'grandfather_name' => ['required'],
            'citizenship_issue_district_id' => ['required'],
            'citizenship_no' => ['required'],
            'citizenship_issue_date' => ['required'],
            'address' => ['required'],
            'local_body' => ['required'],
            'ward_no' => ['required'],
            'files' => ['required', 'array'],
            'files.*.file_name' => ['required'],
            'files.*.file' => ['required'],

        ];
    }
}
