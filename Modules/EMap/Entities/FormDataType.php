<?php

namespace Modules\EMap\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\EMap\Enums\FormTypeEnum;

class FormDataType extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;

    protected static function boot()
    {
        parent::boot();

        static::creating(static function ($model) {
            $model->model_type = $model->type->class();
        });

        static::updating(static function ($model) {
            if ($model->isDirty('type')) {
                $model->model_type = $model->type->class();
            }
        });
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        "form_id",
        "type",
        "model_type",
        "model_id",
        "route_name",
    ];

    protected $casts = [
        "type" => FormTypeEnum::class,
    ];

    public function getOriginalTypeAttribute()
    {
        return $this->attributes['type'];
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function appliedDocuments(): MorphMany
    {
        return $this->morphMany(AppliedDocument::class, 'form_data');
    }

    public function formStores(): MorphMany
    {
        return $this->morphMany(FormStore::class, 'form_data');
    }

    public function paymentStores(): MorphMany
    {
        return $this->morphMany(PaymentStore::class, 'form_data');
    }
}
