<?php

use Illuminate\Support\Facades\Route;
use Modules\TaskManagement\Http\Controllers\Admin\ActivityController;
use Modules\TaskManagement\Http\Controllers\Admin\AllActivityController;
use Modules\TaskManagement\Http\Controllers\Admin\DashboardController;
use Modules\TaskManagement\Http\Controllers\Admin\FileActivityController;
use Modules\TaskManagement\Http\Controllers\Admin\FileTrackingController;
use Modules\TaskManagement\Http\Controllers\Admin\ReportController;

Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
Route::get('dashboard/ajax', [DashboardController::class,'ajaxData'])->name('dashboard.ajax');


Route::resource('allActivity', AllActivityController::class)->only('index');
Route::post('activity/{activity}/assignTask', [ActivityController::class, 'assignTask'])->name('activity.assignTask');
Route::get('activity/excel/import', [ActivityController::class, 'excelImportPage'])->name('activity.excel.import-page');
Route::post('activity/excel/import', [ActivityController::class, 'import'])->name('activity.excel.import');
Route::resource('activity', ActivityController::class)->except('store', 'update');
Route::resource('fileTracking', FileTrackingController::class);
Route::get('fileTracking/{fileTracking}/fileActivity/{fileActivity}/updateReceivedStatus', [FileActivityController::class, 'updateReceivedStatus'])->name('fileTracking.fileActivity.updateReceivedStatus');
Route::put('fileTracking/{fileTracking}/fileActivity/{fileActivity}/updateStatus', [FileActivityController::class, 'updateStatus'])->name('fileTracking.fileActivity.updateStatus');
//report
Route::controller(ReportController::class)->prefix('report')->as('report.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('report-data', 'report')->name('report-data');
    Route::get('daily-report', 'dailyReportPage')->name('dailyReport');
    Route::post('daily-report', 'getDailyReport')->name('getDailyReport');
    Route::get('monthly-report', 'monthlyReportPage')->name('monthlyReport');
    Route::post('monthly-report', 'getMonthlyReport')->name('getMonthlyReport');
    Route::get('quarterly-report', 'quarterlyReportPage')->name('quarterlyReport');
    Route::post('quarterly-report', 'getQuarterlyReport')->name('getQuarterlyReport');
    Route::get('trimonthly-report', 'trimonthlyReportPage')->name('trimonthlyReport');
    Route::post('trimonthly-report', 'getTrimonthlyReport')->name('getTrimonthlyReport');
    Route::get('yearly-report', 'yearlyReportPage')->name('yearlyReport');
    Route::post('yearly-report', 'getYearlyReport')->name('getYearlyReport');
});
