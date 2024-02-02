<?php

namespace Modules\EMap\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\EMap\Enums\DocumentStatusEnum;

class PaymentStore extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;

    protected $touches = ['mapApply'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'form_id',
        'map_apply_id',
        'status',
        'uploaded_by_type',
        'uploaded_by_id',
        'form_data_type',
        'form_data_id',
        'bill',
        'amount'
    ];

    protected $casts = [
        'status' => DocumentStatusEnum::class,
        "amount" => 'float',
    ];

    protected $appends = [
        'can_edit'
    ];

    public function getCanEditAttribute(): bool
    {
        return match ($this->attributes['status']) {
            DocumentStatusEnum::APPROVED->value,
            DocumentStatusEnum::REVIEW->value => false,
            DocumentStatusEnum::PENDING->value,
            DocumentStatusEnum::REJECTED->value => true,
        };
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function mapApply(): BelongsTo
    {
        return $this->belongsTo(MapApply::class);
    }

    public function paymentStoreStatuses(): HasMany
    {
        return $this->hasMany(PaymentStoreStatus::class);
    }
    public function form_data(): MorphTo
    {
        return $this->morphTo();
    }

    public function uploaded_by(): MorphTo
    {
        return $this->morphTo();
    }
}
