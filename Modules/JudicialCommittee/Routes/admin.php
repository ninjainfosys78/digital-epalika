<?php

use Illuminate\Support\Facades\Route;
use Modules\JudicialCommittee\Http\Controllers\Admin\ComplaintApplicationController;
use Modules\JudicialCommittee\Http\Controllers\Admin\ComplaintDecisionController;
use Modules\JudicialCommittee\Http\Controllers\Admin\ComplaintLogController;
use Modules\JudicialCommittee\Http\Controllers\Admin\ConciliationApplicationController;
use Modules\JudicialCommittee\Http\Controllers\Admin\ConciliationController;
use Modules\JudicialCommittee\Http\Controllers\Admin\ConciliationVerificationController;
use Modules\JudicialCommittee\Http\Controllers\Admin\DashboardController;
use Modules\JudicialCommittee\Http\Controllers\Admin\DateCompensationController;
use Modules\JudicialCommittee\Http\Controllers\Admin\DateSheetController;
use Modules\JudicialCommittee\Http\Controllers\Admin\DefendantIssuedDeadlineController;
use Modules\JudicialCommittee\Http\Controllers\Admin\JudicialMemberController;
use Modules\JudicialCommittee\Http\Controllers\Admin\JudicialReceiptBillController;
use Modules\JudicialCommittee\Http\Controllers\Admin\ReportController;
use Modules\JudicialCommittee\Http\Controllers\Admin\Setting\ComplaintSubjectController;
use Modules\JudicialCommittee\Http\Controllers\Admin\Setting\JudicialCommitteeTemplateController;
use Modules\JudicialCommittee\Http\Controllers\Admin\Setting\LawsuitNatureController;
use Modules\JudicialCommittee\Http\Controllers\Admin\WrittenAnswerController;

Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
Route::get('dashboard/ajax', [DashboardController::class,'ajaxData'])->name('dashboard.ajax');

Route::resource('judicialMember', JudicialMemberController::class);
Route::get('complaintApplication/registered', [ComplaintApplicationController::class, 'registeredApplications'])->name('registeredApplication');
Route::post('complaintApplication/{complaintApplication}/supportedDocument', [ComplaintApplicationController::class, 'uploadSupportedDocument'])->name('complaintApplication.supportedDocument.store');
Route::delete('complaintApplication/{complaintApplication}/supportedDocument/{supportedDocument}', [ComplaintApplicationController::class, 'deleteSupportedDocument'])->name('complaintApplication.supportedDocument.destroy');
Route::post('complaintApplication/{complaintApplication}/witness', [ComplaintApplicationController::class, 'storeWitness'])->name('complaintApplication.witness.store');
Route::resource('complaintApplication', ComplaintApplicationController::class);
Route::resource('complaintApplication/{complaintApplication}/judicialReceiptBill', JudicialReceiptBillController::class)->names('complaintApplication.judicialReceiptBill');
Route::resource('complaintApplication/{complaintApplication}/dateSheet', DateSheetController::class)->names('complaintApplication.dateSheet');
Route::resource('complaintApplication/{complaintApplication}/defendantIssuedDeadline', DefendantIssuedDeadlineController::class)->names('complaintApplication.defendantIssuedDeadline');
Route::resource('complaintApplication/{complaintApplication}/dateCompensation', DateCompensationController::class)->names('complaintApplication.dateCompensation');
Route::resource('complaintApplication/{complaintApplication}/writtenAnswer', WrittenAnswerController::class)->names('complaintApplication.writtenAnswer');
Route::resource('complaintApplication/{complaintApplication}/complaintDecision', ComplaintDecisionController::class)->names('complaintApplication.complaintDecision');
Route::resource('complaintApplication/{complaintApplication}/conciliationApplication', ConciliationApplicationController::class)->names('complaintApplication.conciliationApplication');
Route::resource('complaintApplication/{complaintApplication}/conciliationVerification', ConciliationVerificationController::class)->names('complaintApplication.conciliationVerification');
Route::resource('complaintApplication/{complaintApplication}/conciliation', ConciliationController::class)->names('complaintApplication.conciliation');
Route::get('complaintApplication/{complaintApplication}/complaintLog', [ComplaintLogController::class, 'index'])->name('complaintApplication.complaintLog.index');

Route::prefix('setting')->as('setting.')->group(function () {
    Route::resource('lawsuitNature', LawsuitNatureController::class);
    Route::resource('judicialCommitteeTemplate', JudicialCommitteeTemplateController::class);
    Route::resource('complaintSubject', ComplaintSubjectController::class);
});

Route::controller(ReportController::class)->prefix('reports')->as('report.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('report-data', 'report')->name('report-data');
    Route::get('complainant-defendant-report', [ReportController::class, 'complainantDefendantReportPage'])->name('complainant-defendant-report-page');
    Route::post('complaint-defendant-report', [ReportController::class, 'getComplainantDefendantData'])->name('get-complaint-defendant-report');
    Route::get('complaint-subject-wise-report', [ReportController::class, 'complaintSubjectWiseReportPage'])->name('complaint-subject-wise-report-page');
    Route::post('complaint-subject-wise-report', [ReportController::class, 'getComplaintSubjectWiseData'])->name('get-complaint-subject-wise-data');
});
