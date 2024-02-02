<?php

namespace Modules\BusinessRegistration\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class Customs extends Model
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
        'proprietor_detail_id',

    ];

    public function proprietorDetail(): BelongsTo
    {
        return $this->belongsTo(ProprietorDetail::class);
    }


    public function getTotalAmountAttribute()
    {
        return $this->application_fee + $this->registration_fee + $this->business_tax + $this->introduction_board_fees + $this->fine;
    }
}
