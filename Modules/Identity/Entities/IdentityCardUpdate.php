<?php

namespace Modules\Identity\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdentityCardUpdate extends Model
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

     'date',
     'new_data',
     'old_data'
    ];

    public function disabilityIdentityCard(): BelongsTo
    {
        return $this->belongsTo(DisabilityIdentityCard::class);
    }
}
