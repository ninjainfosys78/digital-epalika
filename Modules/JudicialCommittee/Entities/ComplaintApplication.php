<?php

namespace Modules\JudicialCommittee\Entities;

use App\Models\Settings\FiscalYear;
use App\Traits\EventObserveTrait;
use App\Traits\GetAllColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Modules\JudicialCommittee\Enums\ComplaintApplicationStatusEnum;
use Modules\JudicialCommittee\Traits\JudicialCommitteeTemplateTrait;
use Workbench\App\Models\User;

class ComplaintApplication extends Model
{
    use HasFactory;
    use SoftDeletes;
    use JudicialCommitteeTemplateTrait;
    use EventObserveTrait;
    use GetAllColumns;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'fiscal_year_id',
        'submission_no',
        'registration_no',
        'lawsuit_nature_id',
        'complaint_subject_id',
        'subject',
        'complaint_detail',
        'date',
        'en_date',
        'applicant_name',
        'applicant_phone',
        'applicant_address',
        'applicant_signature',
        'application_status',
        'mobile_user_id'
    ];

    protected $appends = [
        'month',
        'en_month'
    ];

    protected $casts = [
        'application_status' => ComplaintApplicationStatusEnum::class
    ];

    public function getApplicantSignatureUrlAttribute(): string
    {
        return !empty($this->attributes['applicant_signature'])
            ? Storage::disk('public')->url($this->attributes['applicant_signature'])
            : '';
    }

    public function setApplicantSignatureAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['applicant_signature'] = $value->store('judicial_committee/applicant_signature', 'public');
        }
    }

    public function getMonthAttribute(): string
    {
        return explode('-', $this->date)[1] ?? '';
    }

    public function getEnMonthAttribute(): string
    {
        return explode('-', $this->en_date)[1] ?? '';
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function lawsuitNature(): BelongsTo
    {
        return $this->belongsTo(LawsuitNature::class);
    }

    public function complainantDefendants(): HasMany
    {
        return $this->hasMany(ComplainantDefendant::class, 'complaint_application_id');
    }

    public function complaintSubject(): BelongsTo
    {
        return $this->belongsTo(ComplaintSubject::class);
    }

    public function judicialReceiptBill(): HasOne
    {
        return $this->hasOne(JudicialReceiptBill::class);
    }

    public function relatedMembers(): HasMany
    {
        return $this->hasMany(RelatedMember::class);
    }

    public function dateSheets(): HasMany
    {
        return $this->hasMany(DateSheet::class);
    }

    public function defendantIssuedDeadlines(): HasMany
    {
        return $this->hasMany(DefendantIssuedDeadline::class);
    }

    public function dateCompensations(): HasMany
    {
        return $this->hasMany(DateCompensation::class);
    }

    public function writtenAnswers(): HasMany
    {
        return $this->hasMany(WrittenAnswer::class);
    }

    public function complaintDecision(): HasOne
    {
        return $this->hasOne(ComplaintDecision::class);
    }

    public function complaintLogs(): HasMany
    {
        return $this->hasMany(ComplaintLog::class);
    }

    public function witnesses(): HasMany
    {
        return $this->hasMany(Witness::class);
    }

    public function supportedDocuments(): HasMany
    {
        return $this->hasMany(SupportedDocument::class);
    }

    public function conciliationApplication(): HasOne
    {
        return $this->hasOne(ConciliationApplication::class);
    }

    public function conciliationVerification(): HasOne
    {
        return $this->hasOne(ConciliationVerification::class);
    }

    public function conciliation(): HasOne
    {
        return $this->hasOne(Conciliation::class);
    }
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }
}
