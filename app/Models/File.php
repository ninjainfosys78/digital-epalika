<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'model_type',
        'model_id',
        'file_name',
        'extension',
        'file',
        'type',
        'user_id'
    ];

    protected $appends = [
        'file_url',
        'file_size'
    ];

    public function getFileUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->attributes['file']);
    }

    public function getFileSizeAttribute(): string
    {
        $filePath = $this->attributes['file'];

        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->size($filePath);
        }

        return 'File not found';
    }
}
