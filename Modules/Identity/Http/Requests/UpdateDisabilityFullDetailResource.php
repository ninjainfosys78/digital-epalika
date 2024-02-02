<?php

namespace Modules\Identity\Http\Requests;

use App\Enums\BloodGroupEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\BusinessRegistration\Enums\Qualification;

class UpdateDisabilityFullDetailResource extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "disability_reason_id" => ['required', Rule::exists('disability_reasons', 'id')->withoutTrashed()],
            "citizenship_no_place" => ['nullable', 'string', 'max:255'],
            "citizenship_date_ad" => ['nullable'],
            "citizenship_date" => ['nullable'],
            "document_photo" => ['nullable', 'file', 'mimes:jpeg,jpg,png'],
            "document_photo_back" => ['nullable', 'file', 'mimes:jpeg,jpg,png'],
            "material_description" => ['required'],
            "qualification" => ['required', new Enum(Qualification::class)],
            "blood_group" => ['required', new Enum(BloodGroupEnum::class)],
            "daily_activity" => ['required'],
            "supporting_material" => ['required'],
            "helping_task" => ['nullable', 'array'],
            "helping_task.*" => ['required','string'],
            "without_helping_task" => ['nullable', 'array'],
            "without_helping_task.*" => ['required','string'],
            "main_training_name" => ['nullable', 'string', 'max:255'],
            "occupation_id" => ['nullable', Rule::exists('occupations', 'id')->withoutTrashed()],
        ];
    }
}
