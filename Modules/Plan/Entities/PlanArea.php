<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class PlanArea extends Model
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
        'plan_area_id',
        'area_name'
    ];

    public function scopeFilterData($query, $params = [])
    {
        if (!empty($params['plan_area_id'])) {
            if (is_array($params['plan_area_id'])) {
                $query->whereIn('plan_area_id', $params['plan_area_id']);
            } else {
                $query->where('plan_area_id', $params['plan_area_id']);
            }
        }

        return $query;
    }

    public function planArea(): BelongsTo
    {
        return $this->belongsTo(__CLASS__);
    }

    public function planAreas(): HasMany
    {
        return $this->hasMany(__CLASS__);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
