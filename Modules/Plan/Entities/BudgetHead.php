<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class BudgetHead extends Model
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
        'budget_head_id',
        'title'
    ];

    public function scopeFilterData($query, $params = [])
    {
        if (!empty($params['budget_head_id'])) {
            if (is_array($params['budget_head_id'])) {
                $query->whereIn('budget_head_id', $params['budget_head_id']);
            } else {
                $query->where('budget_head_id', $params['budget_head_id']);
            }
        }

        return $query;
    }

    public function budgetHead(): BelongsTo
    {
        return $this->belongsTo(BudgetHead::class);
    }

    public function budgetHeads(): HasMany
    {
        return $this->hasMany(BudgetHead::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
