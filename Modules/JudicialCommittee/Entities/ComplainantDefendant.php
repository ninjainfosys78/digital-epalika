<?php

namespace Modules\JudicialCommittee\Entities;

use App\Models\Address\District;
use App\Models\Address\LocalBody;
use App\Models\Address\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\JudicialCommittee\Enums\ComplainantDefendantTypeEnum;

class ComplainantDefendant extends Model
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
        'complaint_application_id',
        'type',
        'name',
        'age',
        'father_name',
        'grandfather_name',
        'spouse_name',
        'province_id',
        'district_id',
        'local_body_id',
        'ward_no',
        'tole',
        'complain_type',
    ];

    protected $casts = [
        'type' => ComplainantDefendantTypeEnum::class,
    ];

    public function complaintApplication(): BelongsTo
    {
        return $this->belongsTo(ComplaintApplication::class, 'complaint_application_id');
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function localBody(): BelongsTo
    {
        return $this->belongsTo(LocalBody::class);
    }
}
