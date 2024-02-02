<?php

namespace Modules\EMap\Entities;

use App\Models\MobileUser;
use App\Models\Otp;
use App\Models\Settings\FiscalYear;
use App\Models\Settings\Units\Unit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Modules\EMap\Enums\ApplicationFormTypeEnum;
use Modules\EMap\Enums\BuildingUsageEnum;
use Modules\EMap\Enums\CategorizationEnum;
use Modules\EMap\Enums\TypeOfConstructionWorkEnum;
use Modules\EMap\Traits\EMapTemplateTrait;

class MapApply extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EMapTemplateTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'sent_to_admin_at',
        'registration_date',
    ];

    protected $fillable = [
        'client_id',
        'unique_id',
        'fiscal_year_id',
        'registration_no',
        'registration_date',
        'construction_type',
        'usage',
        'building_category',
        'structure_type_id',
        'current_storey',
        'future_storey',
        'area_of_plinth',
        'length',
        'breadth',
        'height',
        'organization_id',
        'consultant_signature',
        'consultant_name',
        'consultant_mobile_no',
        'consultant_nec_no',
        'sent_to_admin_at',
        'sent_to_organization',
        'application_type',
        'file_code',
        'number',
        'latitude',
        'longitude',
        'mobile_user_id',
        'comment'
    ];

    protected $casts = [
        'construction_type' => TypeOfConstructionWorkEnum::class,
        'usage' => BuildingUsageEnum::class,
        'building_category' => CategorizationEnum::class,
        'application_type' => ApplicationFormTypeEnum::class
    ];

    public function setConsultantSignatureAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['consultant_signature'] = $value->store('e_map/consultant/signature', 'public');
        }
    }

    public function getConsultantSignatureUrlAttribute(): string
    {
        return $this->attributes['consultant_signature'] ? Storage::disk('public')->url($this->attributes['consultant_signature']) : '';
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }


    public function structureType(): BelongsTo
    {
        return $this->belongsTo(StructureType::class);
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function mobileUser(): BelongsTo
    {
        return $this->belongsTo(MobileUser::class);
    }

    public function landDetail(): HasOne
    {
        return $this->hasOne(LandDetail::class);
    }


    public function landOwner(): HasOne
    {
        return $this->hasOne(LandOwner::class);
    }

    public function houseOwner(): HasOne
    {
        return $this->hasOne(HouseOwner::class);
    }

    public function storeyDetails(): HasMany
    {
        return $this->hasMany(StoreyDetail::class);
    }

    public function fourForts(): HasMany
    {
        return $this->hasMany(FourFort::class);
    }

    public function designerDetails(): HasMany
    {
        return $this->hasMany(DesignerDetail::class);
    }

    public function applicantDetail(): HasOne
    {
        return $this->hasOne(ApplicantDetail::class);
    }

    public function criteriaDetails(): HasMany
    {
        return $this->hasMany(CriteriaDetail::class);
    }

    public function buildingDetails(): HasMany
    {
        return $this->hasMany(BuildingDetail::class);
    }

    public function mapApplyApplications(): HasMany
    {
        return $this->hasMany(ApplyMapApplication::class);
    }

    public function applyMapNotices(): HasMany
    {
        return $this->hasMany(ApplyMapNotice::class);
    }

    public function mapRegistration(): HasOne
    {
        return $this->hasOne(MapRegistration::class);
    }

    public function otp(): MorphOne
    {
        return $this->morphOne(Otp::class, 'model')->latest();
    }

    public function attachDocument(): HasOne
    {
        return $this->hasOne(AttachDocument::class);
    }

    public function scopeSentToAdmin($query)
    {
        return $query->whereNotNull('sent_to_admin_at');
    }

    public function scopeIsMapVerified($query, ApplicationFormTypeEnum $applicationFormTypeEnum)
    {
        return $query->where('application_type', $applicationFormTypeEnum->value);
    }

    public function scopeNotSentToAdmin($query)
    {
        return $query->whereNull('sent_to_admin_at');
    }

    public function appliedDocuments(): HasMany
    {
        return $this->hasMany(AppliedDocument::class);
    }

    public function formStores(): HasMany
    {
        return $this->hasMany(FormStore::class);
    }

    public function paymentStores(): HasMany
    {
        return $this->hasMany(PaymentStore::class);
    }

    public function getCheckFormFilledAttribute($value)
    {
    }

    public function activeStep()
    {
        $this->load('formStores.form:id,order', 'paymentStores.form:id,order', 'appliedDocuments.form:id,order');
        $storedDocuments = collect();

        $storedDocuments =
            $storedDocuments->merge($this->formStores)
            ->merge($this->paymentStores)
            ->merge($this->appliedDocuments)
            ->sortByDesc('created_at');
        return $storedDocuments
            ->map(function ($storedDocument) {
                return collect($storedDocument)
                    ->put('order', $storedDocument->form?->order)
                    ->put('form_id', $storedDocument->form?->id)
                    ->only('order', 'status', 'created_at', 'form_id', 'id')
                    ->toArray();
            })
            ->groupBy('order')
            ->map(function ($form) {
                return [
                    'status' => $form->pluck('status')->unique()->toArray(),
                    'order' => $form->pluck('order')->unique()->max()
                ];
            })
            ->first();
    }

    public function getIndexDataAttribute()
    {
        $this->load('formStores.form', 'paymentStores.form', 'appliedDocuments.form');
        $storedDocuments = collect();

        $storedDocuments =
            $storedDocuments->merge($this->formStores)
            ->merge($this->paymentStores)
            ->merge($this->appliedDocuments)
            ->sortByDesc('created_at');

        return $storedDocuments
            ->map(function ($storedDocument) {
                return collect($storedDocument)
                    ->put('desk', $storedDocument?->form?->load('group')?->group?->title)
                    ->put('form_title', $storedDocument->form?->title)
                    ->only('desk', 'created_at', 'form_title')
                    ->toArray();
            })
            ->map(function ($form) {
                return [
                    'desk' => $form['desk'] ?? '',
                    'status' => $form['form_title'] ?? '',
                    'pendingDays' => (array_key_exists('created_at', $form) && !empty($form['created_at'])) ? Carbon::parse($form['created_at'])?->diffForHumans() : $this->created_at->diffForHumans()

                ];
            })
            ->first();
    }
}
