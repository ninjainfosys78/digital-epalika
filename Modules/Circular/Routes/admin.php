<?php

use Illuminate\Support\Facades\Route;
use Modules\Circular\Http\Controllers\Admin\DashboardController;
use Modules\Circular\Http\Controllers\Admin\DispatchController;
use Modules\Circular\Http\Controllers\Admin\DispatchReportController;
use Modules\Circular\Http\Controllers\Admin\RegistrationController;
use Modules\Circular\Http\Controllers\Admin\RegistrationReportController;
use Modules\Circular\Http\Controllers\CircularSettingController;
use Modules\Circular\Http\Controllers\DispatchDetailController;

Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
Route::get('dashboard/ajax', [DashboardController::class, 'ajaxData'])->name('dashboard.ajax');

Route::resource('circularSetting', CircularSettingController::class);

Route::prefix('files')->as('files.')->group(function () {
    Route::view('registration-file', 'circular::admin.file.registration_file')->name('registration-file');
    Route::view('dispatch-file', 'circular::admin.file.dispatch_file')->name('dispatch-file');
});

Route::resource('registration', RegistrationController::class);
Route::put('registration/{registration}/updateStatus', [RegistrationController::class,'updateStatus'])->name('registration.updateStatus');
Route::get('dispatch/{dispatch}/report', [DispatchController::class,'report'])->name('dispatch.report');
Route::get('dispatch/{dispatch}/print', [DispatchController::class,'print'])->name('dispatch.print');
Route::resource('dispatch', DispatchController::class);
Route::resource('dispatch.dispatchDetail', DispatchDetailController::class);

//dispatch report
Route::controller(DispatchReportController::class)->prefix('report/dispatch')->as('report.dispatch.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('report-data', 'report')->name('report-data');
});
//registration report
Route::controller(RegistrationReportController::class)->prefix('report/registration')->as('report.registration.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('report-data', 'report')->name('report-data');
});
