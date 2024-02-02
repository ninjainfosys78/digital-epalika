<?php

namespace Modules\Recommendation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Support\Facades\Storage;

class SipharishCreatedValue extends Model
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
        'sipharish_form_field_id',
        'value',
        'status',
        'type'
    ];

    public function SipharishCreate(): BelongsTo
    {
        return $this->belongsTo(SipharishCreate::class, 'sipharish_create_id');
    }

    public function SipharisFormField(): BelongsTo
    {
        return $this->belongsTo(SipharisFormField::class, 'sipharish_form_field_id');
    }

    public function getValueDataAttribute(): string
    {
        if (!empty($this->attributes['value'])) {
            if ($this->attributes['type'] == 'image') {
                return "<img src='" . Storage::disk('public')->url($this->attributes['value']) . "'  style='width: 150px;height: 150px;object-fit: contain;' />";
            } else {
                return $this->attributes['value'];
            }
        } else {
            return '';
        }
    }
}
