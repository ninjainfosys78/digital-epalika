<?php

use Illuminate\Support\Facades\Route;
use Modules\EMap\Http\Controllers\Admin\Api\MapApplyFormApiController;

Route::get("mapApplySetting", [MapApplyFormApiController::class, 'getMapApplySetting'])->name('get-map-apply-setting');

//register map application from frontend
Route::post('map-application', [\Modules\EMap\Http\Controllers\Api\MapApplicationController::class,'registerApplication'])->name('register-application');
