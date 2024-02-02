<?php

namespace Modules\EMap\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\EMap\Enums\SignEnum;

class CriteriaDetailSetting extends Model
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
        "land_use_area_id",
        "title",
        "area",
        "sign",
        "gcr",
        "far",
    ];

    protected $casts = [
        "sign" => SignEnum::class,
    ];

    public function landUseArea(): BelongsTo
    {
        return $this->belongsTo(LandUseArea::class);
    }
}
