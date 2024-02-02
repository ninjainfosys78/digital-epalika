<?php

namespace Modules\DigitalBoard\Entities;

use App\Models\File;
use App\Models\Settings\FiscalYear;
use App\Models\User;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
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
        'date',
        'en_date',
        'ward_no',
        'description',
        'closed_at',
        'show_on_index',
        'user_id',
        'type',
        'fiscal_year_id',
    ];

    protected $casts = [
        'ward_no' => 'array',
    ];

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function files(): MorphMany
    // {
    //     return $this->morphMany(File::class, 'model');
    // }

    // public function fiscalYear(): BelongsTo
    // {
    //     return $this->belongsTo(FiscalYear::class);
    // }

    // public function scopeShowInIndex($builder)
    // {
    //     return $builder->where('show_on_index', 1);
    // }

    // public function scopeHideInIndex($builder)
    // {
    //     return $builder->where('show_on_index', 0);
    // }

    // public function scopeNullClosedAt($builder)
    // {
    //     return $builder->whereNull('closed_at');
    // }

    public function scopeNotice($builder)
    {
        return $builder->where('type', 'Notice');
    }

    public function scopeNews($builder)
    {
        return $builder->where('type', "News");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }


    public function scopeShowInIndex($builder)
    {
        return $builder->where('show_on_index', 1);
    }

    public function scopeHideInIndex($builder)
    {
        return $builder->where('show_on_index', 0);
    }

    public function scopeNullClosedAt($builder)
    {
        return $builder->whereNull('closed_at');
    }

    public function scopeContentType($builder, string $type)
    {
        return $builder->where('type', $type);

    }
}
