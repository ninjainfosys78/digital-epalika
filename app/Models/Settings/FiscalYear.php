<?php

namespace App\Models\Settings;

use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Circular\Entities\Dispatch;
use Modules\Circular\Entities\Registration;
use Modules\DigitalBoard\Entities\Notice;
use Modules\EMap\Entities\MapApply;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\Revenue\Entities\Invoice;
use Modules\Roaster\Entities\Training;
use Modules\TaskManagement\Entities\DailyTask;

class FiscalYear extends Model
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
        'title',
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function dispatch(): HasMany
    {
        return $this->hasMany(Dispatch::class);
    }

    public function notices(): HasMany
    {
        return $this->hasMany(Notice::class);
    }

    public function dailyTasks(): HasMany
    {
        return $this->hasMany(DailyTask::class);
    }

    public function mapApplies(): HasMany
    {
        return $this->hasMany(MapApply::class);
    }

    public function complaintApplications(): HasMany
    {
        return $this->hasMany(ComplaintApplication::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class);
    }
}
