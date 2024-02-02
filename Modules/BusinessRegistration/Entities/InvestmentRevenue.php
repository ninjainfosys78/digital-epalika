<?php

namespace Modules\BusinessRegistration\Entities;

use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestmentRevenue extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'object_transaction_id',
        'title',
        'registration_amount',
        'renew_amount',
    ];

    public function objectTransaction(): BelongsTo
    {
        return $this->belongsTo(ObjectTransaction::class);
    }

    public function businessDetails(): HasMany
    {
        return $this->hasMany(BusinessDetail::class);
    }

    public function scopeForRenew($query)
    {
        return $query->where('is_renew', 1);
    }

    public function scopeForRegistration($query)
    {
        return $query->where('is_renew', 0);
    }
}
