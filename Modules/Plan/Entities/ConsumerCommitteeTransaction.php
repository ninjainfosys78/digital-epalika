<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\Plan\Enums\TransactionTypeEnum;

class ConsumerCommitteeTransaction extends Model
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
        'project_id',
        'type',
        'date',
        'amount',
        'remarks'
    ];

    protected $casts = [
        'type' => TransactionTypeEnum::class
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
