<?php

namespace Modules\JudicialCommittee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Support\Facades\Storage;

class JudicialReceiptBill extends Model
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
        'bill_no',
        'entry_person',
        'amount',
        'bill_date',
        'file',
    ];

    public function complaintApplication(): BelongsTo
    {
        return $this->belongsTo(ComplaintApplication::class);
    }

    public function getFileUrlAttribute(): string
    {
        return !empty($this->attributes['file']) ? Storage::disk('public')->url($this->attributes['file']) : '';
    }

    public function setFileAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['file'] = $value->store('judicial_committee/files', 'public');
        }
    }
}
