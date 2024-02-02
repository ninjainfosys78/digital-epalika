<?php

namespace App\Models\Settings;

use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\DigitalBoard\Entities\CitizenCharter;
use Modules\DigitalBoard\Entities\Service;
use Modules\GrievanceHandling\Entities\GrievanceDetail;

class Branch extends Model
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
        'branch_name',
    ];

    public function scopeMainBranch($query)
    {
        return $query->whereNull('branch_id');
    }

    public function ScopeSubBranch($query)
    {
        return $query->whereNotNull('branch_id');
    }

    public function scopeFilterData($query, $params = [])
    {
        if (!empty($params['branch_id'])) {
            if (is_array($params['branch_id'])) {
                $query->whereIn('branch_id', $params['branch_id']);
            } else {
                $query->where('branch_id', $params['branch_id']);
            }
        }

        return $query;
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(__CLASS__);
    }

    public function branches(): HasMany
    {
        return $this->hasMany(__CLASS__);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function branchServices(): HasManyThrough
    {
        return $this->hasManyThrough(Service::class, __CLASS__);
    }

    public function getTotalServiceCountAttribute(): int
    {
        $this->load('services', 'branchServices');
        return count($this->services ?? 0) + count($this->branchServices ?? 0);
    }

    public function citizenCharters(): HasMany
    {
        return $this->hasMany(CitizenCharter::class);
    }
    public function grievanceDetails(): HasMany
    {
        return $this->hasMany(GrievanceDetail::class);
    }
}
