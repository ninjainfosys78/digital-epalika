<?php

namespace Modules\Roaster\Entities;

use App\Enums\AttendanceEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class Attendance extends Model
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
        'training_id',
        'trainee_id',
        'date',
        'status',
    ];

    protected $casts = [
        'status' => AttendanceEnum::class
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }
}
