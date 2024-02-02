<?php

use Illuminate\Support\Facades\Route;
use Modules\Identity\Http\Controllers\CardColorController;
use Modules\Identity\Http\Controllers\DashboardController;
use Modules\Identity\Http\Controllers\DisabilityCommitteeController;
use Modules\Identity\Http\Controllers\DisabilityFullDetailController;
use Modules\Identity\Http\Controllers\DisabilityIdentityCardController;
use Modules\Identity\Http\Controllers\DisabilityIdentityCardReportController;
use Modules\Identity\Http\Controllers\DisabilityPrintController;
use Modules\Identity\Http\Controllers\DisabilityReasonController;
use Modules\Identity\Http\Controllers\DisabilityTypeController;
use Modules\Identity\Http\Controllers\EmployeeSignatureController;
use Modules\Identity\Http\Controllers\GovernmentalDisabilityTypeController;
use Modules\Identity\Http\Controllers\HospitalController;
use Modules\Identity\Http\Controllers\IdentityMeetingController;
use Modules\Identity\Http\Controllers\IdentityPrintController;
use Modules\Identity\Http\Controllers\MinuteTemplateSettingController;
use Modules\Identity\Http\Controllers\RecommendationTemplateSettingController;
use Modules\Identity\Http\Controllers\SeniorCitizenDetailController;
use Modules\Identity\Http\Controllers\SeniorCitizenDetailReportController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/ajax', [DashboardController::class,'ajaxData'])->name('dashboard.ajax');

Route::prefix('setting')->as('setting.')->group(function () {
    Route::resource('disabilityReason', DisabilityReasonController::class);
    Route::resource('disabilityType', DisabilityTypeController::class);
    Route::put('employeeSignature/{employeeSignature}/updateStatus', [EmployeeSignatureController::class, 'updateStatus'])->name('employeeSignature.updateStatus');
    Route::resource('employeeSignature', EmployeeSignatureController::class);
    Route::resource('cardColor', CardColorController::class);
    Route::resource('governmentalDisabilityType', GovernmentalDisabilityTypeController::class);
    Route::resource('hospital', HospitalController::class);
    Route::resource('disabilityCommittee', DisabilityCommitteeController::class);
    Route::get('recommendationTemplateSetting/{recommendationTemplateSetting}/updateStatus', [RecommendationTemplateSettingController::class, 'updateStatus'])->name('recommendationTemplateSetting.updateStatus');
    Route::resource('recommendationTemplateSetting', RecommendationTemplateSettingController::class);
    Route::get('minuteTemplateSetting/{minuteTemplateSetting}/updateStatus', [MinuteTemplateSettingController::class, 'updateStatus'])->name('minuteTemplateSetting.updateStatus');
    Route::resource('minuteTemplateSetting', MinuteTemplateSettingController::class);
});

Route::prefix('disability')->group(function () {
    Route::get('disabilityIdentityCard/search-citizenship', [DisabilityIdentityCardController::class, 'searchCitizenshipNo'])->name('disabilityIdentityCard.searchCitizenshipNo');
    Route::get('disabilityIdentityCard/{disabilityIdentityCard}/print', [DisabilityIdentityCardController::class, 'print'])->name('disabilityIdentityCard.print');
    Route::get('disabilityIdentityCard/{disabilityIdentityCard}/printDetail', [DisabilityIdentityCardController::class, 'printDetail'])->name('disabilityIdentityCard.printDetail');
    Route::get('disabilityIdentityCard/{disabilityIdentityCard}/printAll', [DisabilityIdentityCardController::class, 'printAll'])->name('disabilityIdentityCard.printAll');
    Route::resource('disabilityIdentityCard.disabilityPrint', DisabilityPrintController::class)->only('store');
    Route::post('disabilityIdentityCard/{disabilityIdentityCard}/data', [DisabilityIdentityCardController::class, 'printData'])->name('disabilityIdentityCard.printData');
    Route::post('disabilityIdentityCard/{disabilityIdentityCard}/reportData', [DisabilityIdentityCardController::class, 'reportData'])->name('disabilityIdentityCard.reportData');
    Route::resource('disabilityIdentityCard', DisabilityIdentityCardController::class);
    Route::resource('fullDetail/disabilityIdentityCard', DisabilityFullDetailController::class)->names('disabilityFullDetail')->except('create', 'store', 'destroy');
    Route::get('identityEdit/disabilityIdentityCard/{disabilityIdentityCard}/edit', [IdentityPrintController::class, 'edit'])->name('disabilityPrint.edit');
    Route::get('identityPrint/disabilityIdentityCard/{disabilityIdentityCard}/print', [IdentityPrintController::class, 'printCard'])->name('disabilityIdentityCard.printCard');
    Route::get('identityPrint', [IdentityPrintController::class, 'print'])->name('identityPrint');

    Route::resource('identityPrint/disabilityIdentityCard', IdentityPrintController::class)->names('identityPrint');

    Route::post('admin/identity/disability/identityPrint/{disabilityIdentityCard}/sign', [IdentityPrintController::class, 'updateSign'])
    ->name('disabilityIdentityCard.updateSign');
    Route::resource('disabilityPrint/disabilityIdentityCard', IdentityPrintController::class)->names('disabilityPrint');



});

Route::post('identityMeeting/{identityMeeting}/minute', [IdentityMeetingController::class, 'minuteStore'])->name('identityMeeting.minute.store');
Route::get('identityMeeting/{identityMeeting}/minute', [IdentityMeetingController::class, 'minuteIndex'])->name('identityMeeting.minute');
Route::get('identityMeeting/{identityMeeting}/minutePrint', [IdentityMeetingController::class, 'minutePrint'])->name('identityMeeting.minutePrint');
Route::resource('identityMeeting', IdentityMeetingController::class);

Route::prefix('seniorCitizen')->group(function () {
    Route::get('seniorCitizenDetail/search-citizenship', [SeniorCitizenDetailController::class, 'searchCitizenshipNo'])->name('seniorCitizenDetail.searchCitizenshipNo');
    Route::get('seniorCitizenDetail/{seniorCitizenDetail}/print', [SeniorCitizenDetailController::class, 'print'])->name('seniorCitizenDetail.print');
    Route::resource('seniorCitizenDetail', SeniorCitizenDetailController::class);
});

Route::prefix('seniorCitizenReport')->group(function () {
    Route::post('seniorCitizenReport/reportData', [SeniorCitizenDetailReportController::class, 'report'])->name('seniorCitizenReport.report');
});

Route::prefix('reports')->group(function () {
    Route::get('seniorCitizenReport', [SeniorCitizenDetailReportController::class, 'index'])->name('seniorCitizenReport.index');
    Route::get('senior-citizen-ward-wise', [SeniorCitizenDetailReportController::class, 'seniorCitizenWardWise'])->name('senior-citizen-ward-wise');
    Route::post('senior-citizen-ward-wise-report', [SeniorCitizenDetailReportController::class, 'seniorCitizenWardWiseReport'])->name('senior-citizen-ward-wise-report');
    Route::get('disabilityIdentityCardReport', [DisabilityIdentityCardReportController::class, 'report'])->name('disabilityIdentityCardReport');
    Route::get('ward-wise', [DisabilityIdentityCardReportController::class, 'wardWise'])->name('ward-wise');
    Route::post('ward-wise-report', [DisabilityIdentityCardReportController::class, 'wardWiseReport'])->name('ward-wise-report');
    Route::get('governmental-disability-type', [DisabilityIdentityCardReportController::class, 'governmentalDisabilityType'])->name('governmental-disability-type');
    Route::post('governmental-disability-type-report', [DisabilityIdentityCardReportController::class, 'governmentalDisabilityTypeReport'])->name('governmental-disability-type-report');
    Route::get('disability-type', [DisabilityIdentityCardReportController::class, 'disabilityType'])->name('disability-type');
    Route::post('disability-type-report', [DisabilityIdentityCardReportController::class, 'disabilityTypeReport'])->name('disability-type-report');
});
Route::view('test', 'identity::admin.test');
