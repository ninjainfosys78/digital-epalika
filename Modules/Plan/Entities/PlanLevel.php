<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class PlanLevel extends Model
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
        'plan_level_id',
        'level_name'
    ];

    public function scopeFilterData($query, $params = [])
    {
        if (!empty($params['plan_level_id'])) {
            if (is_array($params['plan_level_id'])) {
                $query->whereIn('plan_level_id', $params['plan_level_id']);
            } else {
                $query->where('plan_level_id', $params['plan_level_id']);
            }
        }

        return $query;
    }

    public function planLevel(): BelongsTo
    {
        return $this->belongsTo(PlanLevel::class);
    }

    public function planLevels(): HasMany
    {
        return $this->hasMany(PlanLevel::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
