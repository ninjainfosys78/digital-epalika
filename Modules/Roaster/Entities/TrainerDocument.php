<?php

namespace Modules\Roaster\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TrainerDocument extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'trainer_id',
        'title',
        'document',
    ];

    public function setDocumentAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['document'] = $value->store('trainer_documents/'.Str::slug($this->attributes['title'], '_'), 'public');
        }
    }

    public function getDocumentUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->attributes['document']);
    }

    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }
}
