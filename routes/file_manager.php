<?php

use App\Http\Controllers\FileManagerController;

Route::get('/', [FileManagerController::class, 'index'])->name('file-manager.index');
