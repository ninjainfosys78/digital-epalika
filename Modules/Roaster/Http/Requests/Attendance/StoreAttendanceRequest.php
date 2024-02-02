<?php

namespace Modules\Roaster\Http\Requests\Attendance;

use App\Enums\AttendanceEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreAttendanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'status' => ['required', new Enum(AttendanceEnum::class)]
        ];
    }
}
