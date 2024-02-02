<?php

namespace Modules\EMap\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FormDocumentFormat extends Model
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
        "form_id",
        "title",
        "description",
        "status",
    ];

    public function scopeStatus(Builder $builder, bool $status = true): void
    {
        $builder->where('status', $status);
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
    //    protected function Title(): Attribute
    //    {
    //        return Attribute::make(
    //            get: fn($value) => $value ?
    //                Storage::disk('public')->url($value)
    //                : '',
    //            set: fn($value) => (!empty($value) && !is_string($value))
    //                ? $value->store('naksaFormDocuments/' . Str::slug($this->attributes['form_id'] ?? 'recommendation', '_'), 'public')
    //                : null
    //        );
    //    }
}
