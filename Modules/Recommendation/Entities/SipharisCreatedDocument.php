<?php

namespace Modules\Recommendation\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SipharisCreatedDocument extends Model
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
        'sipharish_create_id',
        'title',
        'filename',
        'extension'
    ];

    public function SipharishCreate(): BelongsTo
    {
        return $this->belongsTo(SipharishCreate::class);
    }

    protected function Filename(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?
                Storage::disk('public')->url($value)
                : '',
            set: fn ($value) => (!empty($value) && !is_string($value))
                ? $value->store('sipharisSignature/' . Str::slug($this->attributes['full_name'] ?? 'recommendation', '_'), 'public')
                : null
        );
    }
}
