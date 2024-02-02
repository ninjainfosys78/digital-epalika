<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\EMap\Http\Controllers\FrontendController;
use Modules\EMap\Http\Controllers\OrganizationAuthController;

// Route::prefix('organization')->as('organization.')->group(function () {
//     Route::get('login', [OrganizationAuthController::class, 'showOrganizationLoginForm'])->name('login.form');
//     Route::post('login', [OrganizationAuthController::class, 'organizationLogin'])->name('login');
//     Route::get('register', [OrganizationAuthController::class, 'showOrganizationRegisterForm'])->name('register.form');
//     Route::get('register-person', [OrganizationAuthController::class, 'showOrganizationRegisterFormPerson'])->name('register.formPerson');
//     Route::post('logout', [OrganizationAuthController::class, 'logout'])->name('logout');
//     Route::get('{organization}/invitation', [OrganizationAuthController::class, 'invitation'])->name('invitation');
//     Route::get('password/create', [OrganizationAuthController::class, 'create'])->name('password.create')->middleware(['password.check']);
//     Route::post('password/store', [OrganizationAuthController::class, 'store'])->name('password.store')->middleware(['password.check']);
// });

Route::controller(FrontendController::class)->group(function () {
    Route::get('ebps', 'eMap')->name('ebps');
    Route::get('downloads', 'downloads');
    Route::get('form', 'form');
    Route::get('mapTrack', 'mapTrack')->name('mapTrack');
    Route::get('formDetails', 'formDetails')->name('formDetails');
    Route::get('mapForm', 'mapForm')->name('mapForm');
    Route::post('map-track', 'track_Map')->name('map-track');
    Route::get('mapApply/{mapApply:uuid}/trackData', 'trackData')->name('track-data');
    Route::get('mapApply/{mapApply:uuid}/sendOtp', 'sendOtp')->name('send-otp');
    Route::post('mapApply/{mapApply:uuid}/verifyOtp', 'verifyOtp')->name('verify-otp');
    Route::get('mapApply/{mapApply:uuid}/{noticeTypeEnum}/trackData', 'loadTemplateData')->name('load-template-data');
    Route::post('mapApply/{mapApply:uuid}/{noticeTypeEnum}/storeEmapTemplateData', 'storeEmapTemplateData')->name('store-emap-template-data');
});
