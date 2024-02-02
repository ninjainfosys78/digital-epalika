<?php

namespace Modules\Circular\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class CircularSetting extends Model
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
        'registration_prefix',
        'dispatch_prefix',
        'registration_number',
        'dispatch_number',
        'send_email'
    ];

    public function dispatches()
    {
        return $this->hasMany(Dispatch::class);
    }
}
