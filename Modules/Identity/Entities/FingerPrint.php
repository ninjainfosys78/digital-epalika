<?php

namespace Modules\Identity\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class FingerPrint extends Model
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
        'model_type',
        'finger_image',
        'model_id',
        'iso_temp',
        'ansi_temp',
        'iso_image',
        'finger',
        'user_id',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
