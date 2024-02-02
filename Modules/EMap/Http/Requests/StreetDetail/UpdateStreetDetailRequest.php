<?php

namespace Modules\EMap\Http\Requests\StreetDetail;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Modules\EMap\Enums\RoadConditionEnum;
use Modules\EMap\Enums\RoadTypeEnum;

class UpdateStreetDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return  [

            'name' => ['required', 'string', 'max:255'],
            'from' => ['required','string','max:255'],
            'to' => ['required', 'string', 'max:255'],
            'setback' => ['required', 'string', 'max:255'],
            'street_code' => ['required', 'string', 'max:255'],
            'condition' => ['required', new Enum(RoadConditionEnum::class)],
            'wards' => ['required', 'string', 'max:255'],
            'right_of_way' => ['required', 'string', 'max:255'],
            'width' => ['required', 'string', 'max:255'],
            'road_type' => ['required', new Enum(RoadTypeEnum::class)],
            'coordinates' => ['nullable', 'json']
        ];
    }
}
