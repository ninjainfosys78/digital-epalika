<?php

use Modules\Revenue\Http\Controllers\RevenueController;

Route::prefix('revenue')->group(function () {
    Route::get('/', [RevenueController::class, 'index']);
});
