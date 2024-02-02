<?php

namespace Modules\EMap\Entities;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\EMap\Enums\NoticeTypeEnum;

class ApplyMapNotice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'rejected_at',
        'sent_to_admin_at',
    ];

    protected $fillable = [
        'map_apply_id',
        'file_type',
        'data',
        'rejected_at',
        'remarks',
        'type',
        'sent_to_admin_at',
    ];


    protected $casts = [
        'file_type' => NoticeTypeEnum::class,
    ];

    public function scopeRejected($query)
    {
        return $query->whereNull('rejected_at');
    }

    public function getApplicationTypeAttribute()
    {
        return $this->attributes['file_type'];
    }

    public function getIsSentAttribute(): bool
    {
        return !empty($this->attributes['sent_to_admin_at']);
    }

    public function mapApply(): BelongsTo
    {
        return $this->belongsTo(MapApply::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }

    public function scopeSentToAdmin($query)
    {
        return $query->whereNotNull('sent_to_admin_at');
    }

    public function scopeNotSentToAdmin($query)
    {
        return $query->whereNull('sent_to_admin_at');
    }
}
