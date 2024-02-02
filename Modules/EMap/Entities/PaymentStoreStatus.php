<?php

namespace Modules\EMap\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\EMap\Enums\DocumentStatusEnum;

class PaymentStoreStatus extends Model
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
        'payment_store_id',
        'status',
        'comment',
        'bill',
        'amount',
    ];

    protected $casts = [
        'status' => DocumentStatusEnum::class,
        'amount' => 'float'
    ];

    public function paymentStore(): BelongsTo
    {
        return $this->belongsTo(PaymentStore::class);
    }
}
