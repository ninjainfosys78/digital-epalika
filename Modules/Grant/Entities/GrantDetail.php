<?php

namespace Modules\Grant\Entities;

use App\Models\Address\LocalBody;
use App\Models\Settings\Branch;
use App\Models\User;
use App\Traits\GetAllColumns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\Grant\Enums\GranteeEnum;

class GrantDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;
    use GetAllColumns;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'grant_id',
        'grant_for',
        'model_type',
        'model_id',
        'personal_investment',
        'is_old',
        'prev_fiscal_year_id',
        'investment_amount',
        'remarks',
        'local_body_id',
        'ward_no',
        'village',
        'tole',
        'plot_no',
        'contact_person',
        'contact',
        'grant_amount'
    ];

    protected $casts = [
        'grant_for' => GranteeEnum::class
    ];

    public function grant(): BelongsTo
    {
        return $this->belongsTo(Grant::class);
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
    public function localBody(): BelongsTo
    {
        return $this->belongsTo(LocalBody::class);
    }

}
