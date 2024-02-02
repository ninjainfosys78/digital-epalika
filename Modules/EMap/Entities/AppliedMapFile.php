<?php

namespace Modules\EMap\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Support\Facades\Storage;

class AppliedMapFile extends Model
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
        "fileable",
        "map_apply_id",
        "document",
    ];

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }

    public function mapApplyId(): BelongsTo
    {
        return $this->belongsTo(MapApply::class);
    }

    // public function Document(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn($value) => Storage::disk('public')->url($value),
    //         set: fn($value) => (!empty($value) && !is_string($value)) ? $value->store('mapApplies', 'public') : null,
    //     );
    // }

    public function getDocumentUrlAttribute()
    {
        return $this->attributes['document'] ? Storage::disk('public')->url($this->attributes['document']) : '';
    }
}
