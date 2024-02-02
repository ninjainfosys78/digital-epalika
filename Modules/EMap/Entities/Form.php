<?php

namespace Modules\EMap\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\EMap\Enums\EMapFormFillerTypeEnum;

class Form extends Model
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
        "title",
        "order",
        "form_type",
        "status",
        "map_pass_group_id",
        "need_from",
        "show_to_consultancy",
        "map_group_id"
    ];

    protected $casts = [
        "need_from" => EMapFormFillerTypeEnum::class,
        "order" => 'integer',
        "status" => 'bool',
        "map_pass_group_id" => 'integer',
        "dynamic_form_id" => 'integer',
    ];


    public function formDataTypes(): HasMany
    {
        return $this->hasMany(FormDataType::class);
    }

    public function scopeStatus(Builder $builder, bool $status = true): void
    {
        $builder->where('status', $status);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(MapPassGroup::class, 'map_pass_group_id');
    }

    public function mapGroup(): BelongsTo
    {
        return $this->belongsTo(MapPassGroup::class, 'map_group_id');
    }

    public function dynamicForm(): BelongsTo
    {
        return $this->belongsTo(DynamicForm::class);
    }

    public function formDocumentFormats(): HasMany
    {
        return $this->hasMany(FormDocumentFormat::class);
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

    public function getFormApproveAttribute()
    {
        return  \Illuminate\Support\Facades\DB::table('map_pass_group_user')
            ->where('map_pass_group_id', $this->attributes['map_group_id'])
            ->where('user_id', auth()->user()->id)
            ->exists();
    }
}
