<?php

namespace Modules\Plan\Entities;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\Plan\Enums\ConsumerCommitteePostEnum;

class ConsumerCommitteeOfficial extends Model
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
        'consumer_committee_id',
        'post',
        'name',
        'father_name',
        'grandfather_name',
        'address',
        'gender',
        'phone',
        'citizenship_no'
    ];

    protected $casts = [
        'post' => ConsumerCommitteePostEnum::class,
        'gender' => Gender::class
    ];

    public function consumerCommittee(): BelongsTo
    {
        return $this->belongsTo(ConsumerCommittee::class);
    }
}
