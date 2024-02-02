<?php

namespace Modules\DigitalBoard\Entities;

use App\Models\Settings\Branch;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
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
        'branch_id',
        'service_name',
        'time_taken',
        'responsible_officer',
        'office',
        'remarks',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function serviceDocuments(): HasMany
    {
        return $this->hasMany(ServiceDocument::class)->orderBy('position');
    }

    public function serviceProcesses(): HasMany
    {
        return $this->hasMany(ServiceProcess::class)->orderBy('position');
    }

    public function serviceEmployees(): HasMany
    {
        return $this->hasMany(ServiceEmployee::class)->orderBy('position');
    }
}
