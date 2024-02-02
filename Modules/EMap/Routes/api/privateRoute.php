<?php

use Illuminate\Support\Facades\Route;
use Modules\EMap\Http\Controllers\Admin\Api\MapApplyFormApiController;

Route::post("mapApply", [MapApplyFormApiController::class, 'store'])
    ->name('api-form-apply-map.store');
Route::get("registeredMap", [MapApplyFormApiController::class, 'registeredMap'])
    ->name('api-form-apply-map.registeredMap');
