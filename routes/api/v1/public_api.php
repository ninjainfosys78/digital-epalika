<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\v1\AddressApiController;
use App\Http\Controllers\Api\v1\PublicApiController;
use Illuminate\Support\Facades\Route;

Route::get('admin/get-auth-token', [PublicApiController::class, 'getToken'])->name('get-token');
Route::get('/', [PublicApiController::class, 'index'])->name('public-api.index');
Route::get('govt-services', [PublicApiController::class, 'getGovtServices'])->name('get-govt-services');
Route::get('slider', [PublicApiController::class, 'slider'])->name('public-api.slider');
Route::get('importantLink', [PublicApiController::class, 'importantLink'])->name('public-api.important-link');
Route::get('setting', [PublicApiController::class, 'setting'])->name('public-api.setting');
Route::get('introduction', [PublicApiController::class, 'introduction'])->name('public-api.introduction');
Route::get('emergencyCategory', [PublicApiController::class, 'emergencyCategory'])->name('public-api.emergencyCategory');
Route::get('emergencyCategory/{emergencyCategory}/emergencyNumber', [PublicApiController::class, 'emergencyNumber'])->name('public-api.emergencyNumber');
Route::post('mobile/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [PublicApiController::class, 'forgotPassword']);
Route::post('mobile/signup', [AuthController::class, 'signup']);
Route::prefix('address')
    ->as('address.')
    ->controller(AddressApiController::class)
    ->group(function () {
        Route::get('province', 'provinces')->name('province.index');
        Route::get('province/{province}', 'province')->name('province.show');
        Route::get('district', 'districts')->name('district.index');
        Route::get('district/{district}', 'district')->name('district.show');
        Route::get('localBody', 'localBodies')->name('localBody.index');
        Route::get('localBody/{localBody}', 'localBody')->name('localBody.show');
    });
