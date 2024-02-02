<?php

namespace Modules\EMap\Entities;

use App\Enums\ApplicationTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ApplyMapApplication extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'rejected_at',
    ];

    protected $fillable = [
        'map_apply_id',
        'file',
        'file_type',
        'rejected_at',
        'remarks',
    ];

    protected $casts = [
        'file_type' => ApplicationTypeEnum::class,
    ];

    public function getApplicationTypeAttribute()
    {
        return $this->attributes['file_type'];
    }

    public function mapApply(): BelongsTo
    {
        return $this->belongsTo(MapApply::class);
    }

    public function setFileAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['file'] = $value->store('applyMapApplication', 'public');
        }
    }

    public function getFileUrlAttribute(): string
    {
        return $this->attributes['file'] ? Storage::disk('public')->url($this->attributes['file']) : '';
    }
}
