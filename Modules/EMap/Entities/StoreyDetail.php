<?php

namespace Modules\EMap\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreyDetail extends Model
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
        'map_fee_id',
        'area_of_proposed_construction',
        'area_of_former_construction',
        'total_area',
        'height',
    ];

    public function mapApply(): BelongsTo
    {
        return $this->belongsTo(MapApply::class);
    }

    public function mapFee(): BelongsTo
    {
        return $this->belongsTo(MapFee::class);
    }

    public function getAmountAttribute(): float|int
    {
        return ($this->total_area ?? 1) * ($this->mapFee->rate ?? 1);
    }

    public function getTotalRateAttribute(): float|int
    {
        return $this->mapFee->sum('rate') ?? 0;
    }
}
