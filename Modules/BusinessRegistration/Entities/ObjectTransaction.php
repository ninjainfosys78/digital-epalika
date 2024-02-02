<?php

namespace Modules\BusinessRegistration\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObjectTransaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'object_transaction_id',
    ];

    public function objectTransaction(): BelongsTo
    {
        return $this->belongsTo(__CLASS__);
    }

    public function objectTransactions(): HasMany
    {
        return $this->hasMany(__CLASS__);
    }

    public function businessDetails(): HasMany
    {
        return $this->hasMany(BusinessDetail::class);
    }
}
