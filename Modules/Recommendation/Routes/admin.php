<?php

use Illuminate\Support\Facades\Route;
use Modules\Recommendation\Http\Controllers\Admin\DashboardController;
use Modules\Recommendation\Http\Controllers\Admin\PersonalDetailController;
use Modules\Recommendation\Http\Controllers\Admin\RecommendationTemplateController;
use Modules\Recommendation\Http\Controllers\Admin\RegistrationDetailController;
use Modules\Recommendation\Http\Controllers\RecommendationCategoryController;
use Modules\Recommendation\Http\Controllers\RecommendationSettingController;
use Modules\Recommendation\Http\Controllers\SipharishCategoryController;
use Modules\Recommendation\Http\Controllers\ReportController;
use Modules\Recommendation\Http\Controllers\SipharisSubCategoryController;
use Modules\Recommendation\Http\Controllers\SipharishFormTypeController;
use Modules\Recommendation\Http\Controllers\SipharisCreateController;
use Modules\Recommendation\Http\Controllers\SignatureDetailController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/ajax', [DashboardController::class, 'ajaxData'])->name('dashboard.ajax');
Route::prefix('setting')->as('setting.')->group(function () {
    Route::resource('recommendationSetting', RecommendationSettingController::class)->only(['index', 'update']);
    Route::get('{type}/recommendationCategory/{recommendationCategory}/recommendationTemplate/{recommendationTemplate}/updateStatus', [RecommendationTemplateController::class, 'updateStatus'])->name('recommendationTemplate.updateStatus');
    Route::get('recommendationCategory/{recommendationCategory}/getTemplate', [RecommendationCategoryController::class, 'getTemplateData'])->name('recommendationCategory.getTemplate');
    Route::get('{type}/recommendationCategory/{recommendationCategory}/updateStatus', [RecommendationCategoryController::class, 'updateStatus'])->name('recommendationCategory.updateStatus');
    Route::resource('{type}/recommendationCategory', RecommendationCategoryController::class);
    Route::resource('{type}/recommendationCategory.recommendationTemplate', RecommendationTemplateController::class);
    Route::resource('personalDetail', PersonalDetailController::class);
});

Route::post('registrationDetail/{registrationDetail}/ocFile', [RegistrationDetailController::class, 'ocFile'])->name('registrationDetail.ocFile');
Route::resource('recommendationCategory.registrationDetail', RegistrationDetailController::class);

Route::prefix('sipharish')->as('sipharish.')->group(function () {
    Route::get('sipharishCategory/{sipharisModel}/toggleStatus', [SipharishCategoryController::class, 'updateStatus'])->name('sipharishCategory.updateStatus');
    Route::resource('sipharishCategory', SipharishCategoryController::class);
    Route::get('sipharishSubCategory/{sipharisSubCategory}/toggleStatus', [SipharisSubCategoryController::class, 'updateStatus'])->name('sipharishSubCategory.updateStatus');
    Route::resource('sipharishSubCategory', SipharisSubCategoryController::class);
    Route::get('sipharishFormType/{sipharisFormType}/toggleStatus', [SipharishFormTypeController::class, 'updateStatus'])->name('sipharishFormType.updateStatus');
    Route::put('sipharishFormType/{sipharishFormType}/updateTemplate', [SipharishFormTypeController::class, 'updateTemplate'])->name('sipharishFormType.updateTemplate');
    Route::resource('sipharishFormType', SipharishFormTypeController::class);
    Route::get('sipharisSignatureDetail/{sipharisSignatureDetail}/toggleStatus', [SignatureDetailController::class, 'updateStatus'])->name('sipharisSignatureDetail.updateStatus');
    Route::resource('sipharisSignatureDetail', SignatureDetailController::class);
    Route::get('sipharishCreate/{sipharishCreate}/toggleStatus', [SipharisCreateController::class, 'updateStatus'])->name('sipharishCreate.updateStatus');
    Route::put('sipharishCreate/{sipharishCreate}/fileUpload', [SipharisCreateController::class, 'fileUpload'])->name('fileUpload');
    Route::resource('sipharishCreate', SipharisCreateController::class);
});

Route::get('sipharish/sipharishCreate/show/{id}', [SipharisCreateController::class, 'show'])->name('sipharishCreate.view');

Route::prefix('report')->as('report.')->controller(ReportController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('report-data', 'report')->name('report-data');
    Route::get('ward-wise', 'wardWise')->name('ward-wise');
    Route::post('ward-wise-report', 'wardWiseReport')->name('ward-wise-report');
    Route::get('recommendation-category-wise', 'recommendationCategoryWise')->name('recommendation-category-wise');
    Route::post('recommendation-category-wise-report', 'recommendationCategoryWiseReport')->name('recommendation-category-wise-report');
    Route::get('personal-detail', 'personalDetail')->name('personal-detail');
    Route::post('personal-detail-report', 'personalDetailReport')->name('personal-detail-report');
});
