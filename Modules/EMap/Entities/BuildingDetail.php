<?php

namespace Modules\EMap\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\EMap\Enums\BuildingDetailEnum;

class BuildingDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'map_apply_id',
        'detail',
        'description',
        'remarks',
    ];

    protected $casts = [
        'detail' => BuildingDetailEnum::class,
    ];

    public function mapApply(): BelongsTo
    {
        return $this->belongsTo(MapApply::class);
    }
}
