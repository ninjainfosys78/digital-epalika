<?php

namespace Modules\EMap\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\EMap\Enums\RoadConditionEnum;
use Modules\EMap\Enums\RoadTypeEnum;

class StreetDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
     "name",
     "from",
     "to",
     "setback",
     "street_code",
     "condition",
     "wards",
     "right_of_way",
     "width",
     "road_type",
     "coordinates",
    ];


    protected $casts = [
     "coordinates" => 'json',
     "condition" => RoadConditionEnum::class,
     "road_type" => RoadTypeEnum::class,
];
}
