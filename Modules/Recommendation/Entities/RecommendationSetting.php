<?php

namespace Modules\Recommendation\Entities;

use App\Models\Settings\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class RecommendationSetting extends Model
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
        'ward_chairman_id',
        'ward_secretary_id',
        'user_id',
        'ward_no'
    ];

    public function wardChairman(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'ward_chairman_id');
    }

    public function wardSecretary(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'ward_secretary_id');
    }
}
