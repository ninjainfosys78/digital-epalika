<?php

use Illuminate\Support\Facades\Route;
use Modules\GrievanceHandling\Http\Controllers\Admin\DashboardController;
use Modules\GrievanceHandling\Http\Controllers\Admin\GrievanceDetailController;
use Modules\GrievanceHandling\Http\Controllers\Admin\GrievanceUserController;
use Modules\GrievanceHandling\Http\Controllers\Admin\Setting\{GrievanceTypeController};
use Modules\GrievanceHandling\Http\Controllers\GrievanceSettingController;

Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
Route::get('dashboard/ajax', [DashboardController::class,'ajaxData'])->name('dashboard.ajax');

Route::prefix('setting')->as('setting.')->group(function () {
    Route::resource('grievanceType', GrievanceTypeController::class);
    Route::resource('grievanceSetting', GrievanceSettingController::class)->only(['index', 'update']);
});

Route::resource('grievanceDetail', GrievanceDetailController::class);
Route::get('grievanceDetail/{grievanceDetail}/approve', [GrievanceDetailController::class, 'approve'])->name('grievanceDetail.approve');
Route::get('grievanceDetail/{grievanceDetail}/public', [GrievanceDetailController::class, 'showToPublic'])->name('grievance-detail.show-to-public');
Route::post('grievanceDetail/{grievanceDetail}/replyGrievance', [GrievanceDetailController::class, 'replyGrievance'])->name('grievanceDetail.replyGrievance');
Route::put('grievanceDetail/{grievanceDetail}/UpdateStatus', [GrievanceDetailController::class, 'updateStatus'])->name('grievanceDetail.updateStatus');
Route::Post('grievanceDetail/{grievanceDetail}/grievanceTransfer', [GrievanceDetailController::class, 'grievanceTransfer'])->name('grievanceDetail.grievanceTransfer');
Route::resource('grievanceUser', GrievanceUserController::class);
