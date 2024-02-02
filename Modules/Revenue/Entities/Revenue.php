<?php

namespace Modules\Revenue\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class Revenue extends Model
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
        'revenue_category_id',
        'code_no',
        'title',
        'description',
        'amount',
        'is_active',
        'remarks',
        'user_id',
    ];

    protected $casts = [
        'amount' => 'float',
        'is_active' => 'boolean',
    ];

    public function revenueCategory(): BelongsTo
    {
        return $this->belongsTo(RevenueCategory::class, 'revenue_category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeNotActive($query)
    {
        return $query->where('is_active', false);
    }
}
