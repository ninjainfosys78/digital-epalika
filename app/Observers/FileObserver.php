<?php

namespace App\Observers;

use App\Models\File;

class FileObserver
{
    public function creating(File $file): void
    {
        if (auth()->check()) {
            $file->user_id = auth()->id();
        }
    }
}
