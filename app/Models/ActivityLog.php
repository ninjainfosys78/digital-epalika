<?php

namespace App\Models;

use App\Traits\QueryFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityLog extends Model
{
    use HasFactory;
    use SoftDeletes;
    use QueryFilterTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'model_type',
        'model_id',
        'activity_type',
        'user_id',
        'ip',
        'agent',
        'performed_action_on',
        'is_seen',
    ];

    public function scopeFilter($query, $param = [])
    {
        $this->filterByUserRole($query, $param);

        return $query;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
