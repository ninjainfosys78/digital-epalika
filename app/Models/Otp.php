<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Otp extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected static function boot()
    {
        parent::boot();

        static::creating(static function ($model) {
            $model->expire_at = now()->addMinutes(config('app.otp_expiry_time'));
        });
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'expire_at',
    ];

    protected $fillable = [
        'model_id',
        'model_type',
        'otp',
        'expire_at',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->attributes['expire_at'] <= now();
    }
}
