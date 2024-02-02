<?php

use Modules\Identity\Http\Controllers\IdentityController;

Route::prefix('identity')->group(function () {
    Route::get('/', [IdentityController::class, 'index']);
});
