<?php

namespace Modules\Recommendation\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SipharisCategory extends Model
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
        'title',
        'status',
        'created_by'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeStatus(Builder $query, bool $status = true): Builder
    {
        return $query->where('status', $status);
    }

    public function SipharisSubCategories(): HasMany
    {
        return $this->hasMany(SipharisSubCategory::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
