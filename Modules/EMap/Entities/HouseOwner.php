<?php

namespace Modules\EMap\Entities;

use App\Models\Address\District;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class HouseOwner extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'map_apply_id',
        'name',
        'phone',
        'father_name',
        'grandfather_name',
        'citizenship_issue_district_id',
        'citizenship_no',
        'citizenship_issue_date',
        'address',
        'local_body',
        'ward_no',
    ];

    public function oldMaps(): BelongsToMany
    {
        return $this->belongsToMany(OldMap::class);
    }


    public function mapApplies(): BelongsToMany
    {
        return $this->belongsToMany(MapApply::class);
    }

    public function mapApply(): BelongsTo
    {
        return $this->belongsTo(MapApply::class);
    }

    public function citizenshipIssueDistrict(): BelongsTo
    {
        return $this->belongsTo(District::class, 'citizenship_issue_district_id');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'model');
    }
}
