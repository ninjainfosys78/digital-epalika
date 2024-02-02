<?php

namespace Modules\Recommendation\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SipharisSignatureDetail extends Model
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
        'full_name',
        'position',
        'signature',
        'status',
        'created_by'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected function Signature(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?
                Storage::disk('public')->url($value)
                : '',
            set: fn ($value) => (!empty($value) && !is_string($value))
                ? $value->store('sipharisSignature/' . Str::slug($this->attributes['full_name'], '_'), 'public')
                : null
        );
    }


    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
