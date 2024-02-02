<?php

use Illuminate\Support\Facades\Route;
use Modules\Plan\Http\Controllers\Admin\ConsumerCommitteeTransactionController;
use Modules\Plan\Http\Controllers\Admin\DashboardController;
use Modules\Plan\Http\Controllers\Admin\ProjectAgreementController;
use Modules\Plan\Http\Controllers\Admin\ProjectAgreementTermController;
use Modules\Plan\Http\Controllers\Admin\ProjectBidSubmissionController;
use Modules\Plan\Http\Controllers\Admin\ProjectController;
use Modules\Plan\Http\Controllers\Admin\ProjectCostDetailController;
use Modules\Plan\Http\Controllers\Admin\ProjectDeadlineExtensionController;
use Modules\Plan\Http\Controllers\Admin\ProjectDocumentController;
use Modules\Plan\Http\Controllers\Admin\ProjectMaintenanceArrangementController;
use Modules\Plan\Http\Controllers\Admin\ReportController;
use Modules\Plan\Http\Controllers\Admin\Setting\BudgetHeadController;
use Modules\Plan\Http\Controllers\Admin\Setting\ExpenseHeadController;
use Modules\Plan\Http\Controllers\Admin\Setting\PlanAreaController;
use Modules\Plan\Http\Controllers\Admin\Setting\PlanLevelController;
use Modules\Plan\Http\Controllers\Admin\Setting\PlanTemplateController;
use Modules\Plan\Http\Controllers\Admin\TechnicalCostEstimateController;
use Modules\Plan\Http\Controllers\CargoHandlingController;
use Modules\Plan\Http\Controllers\CrewRateController;
use Modules\Plan\Http\Controllers\EquipmentAdditionalCostController;
use Modules\Plan\Http\Controllers\EquipmentController;
use Modules\Plan\Http\Controllers\FuelController;
use Modules\Plan\Http\Controllers\FuelDemandController;
use Modules\Plan\Http\Controllers\FuelRateController;
use Modules\Plan\Http\Controllers\LabourController;
use Modules\Plan\Http\Controllers\LabourRateController;
use Modules\Plan\Http\Controllers\MaterialCollectionController;
use Modules\Plan\Http\Controllers\MaterialController;
use Modules\Plan\Http\Controllers\MaterialRateController;
use Modules\Plan\Http\Controllers\MaterialTypeController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/ajax', [DashboardController::class, 'ajaxData'])->name('dashboard.ajax');

Route::get('project/{project}/file-list', [ProjectController::class, 'fileList'])->name('project.fileList');
Route::get('project{project}/upload-file', [ProjectController::class, 'uploadFilePage'])->name('project.uploadFilePage');
Route::post('project/{project}/upload-file', [ProjectController::class, 'uploadFile'])->name('project.uploadFile');
Route::get('project/{project}/{planTemplateTypeEnum}/print', [ProjectController::class, 'print'])->name('project.print');
Route::get('project/{project}/planTemplate/{planTemplate}', [ProjectController::class, 'templateData'])->name('project.templateData');
Route::resource('project', ProjectController::class);
Route::resource('project/{project}/projectCostDetail', ProjectCostDetailController::class)->names('project.projectCostDetail')->only('index');
Route::resource('project/{project}/projectDocument', ProjectDocumentController::class)->names('project.projectDocument');
Route::controller(ProjectAgreementController::class)->prefix('project/{project}/projectAgreement')->as('project.projectAgreement.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('consumer-committee', 'storeConsumerCommittee')->name('consumer-committee');
    Route::post('bid-detail', 'storeProjectBidDetail')->name('bid-detail');
});
Route::resource('project/{project}/projectAgreementTerm', ProjectAgreementTermController::class)->names('project.projectAgreementTerm');
Route::resource('project/{project}/projectBidSubmission', ProjectBidSubmissionController::class)->names('project.projectBidSubmission');
Route::resource('project/{project}/consumerCommitteeTransaction', ConsumerCommitteeTransactionController::class)->names('project.consumerCommitteeTransaction');
Route::resource('project/{project}/projectMaintenanceArrangement', ProjectMaintenanceArrangementController::class)->names('project.projectMaintenanceArrangement');
Route::resource('project/{project}/technicalCostEstimate', TechnicalCostEstimateController::class)->names('project.technicalCostEstimate');
Route::resource('project/{project}/projectDeadlineExtension', ProjectDeadlineExtensionController::class)->names('project.projectDeadlineExtension');

Route::prefix('setting')->group(function () {
    Route::get('planSubArea', [PlanAreaController::class, 'planSubArea'])->name('planSubArea');
    Route::resource('{type}/planArea', PlanAreaController::class)->except('show');
    Route::get('planSubLevel', [PlanLevelController::class, 'planSubLevel'])->name('planSubLevel');
    Route::resource('{type}/planLevel', PlanLevelController::class)->except('show');
    Route::get('budgetSubHead', [BudgetHeadController::class, 'budgetSubHead'])->name('budgetSubHead');
    Route::resource('{type}/budgetHead', BudgetHeadController::class)->except('show');
    Route::resource('planTemplate', PlanTemplateController::class);
    Route::resource('expenseHead', ExpenseHeadController::class);
});

Route::prefix('estimateSetting')->group(function () {
    Route::resource('labour', LabourController::class);
    Route::resource('labourRate', LabourRateController::class);
    Route::resource('fuel', FuelController::class);
    Route::resource('fuelRate', FuelRateController::class);
    Route::resource('equipment', EquipmentController::class);
    Route::get('equipmentAdditionalCost/create', [EquipmentAdditionalCostController::class, 'create'])->name('equipmentAdditionalCost.create');
    Route::get('equipmentAdditionalCost', [EquipmentAdditionalCostController::class, 'index'])->name('equipmentAdditionalCost.index');
    Route::get('equipment/{equipment}', [EquipmentAdditionalCostController::class, 'edit'])->name('equipmentAdditionalCost.edit');
    Route::delete('equipment/{equipment}/delete', [EquipmentAdditionalCostController::class, 'destroy'])->name('equipmentAdditionalCost.delete');

    Route::resource('fuelDemand', FuelDemandController::class);
    Route::resource('crewRate', CrewRateController::class);
    Route::resource('materialType', MaterialTypeController::class);
    Route::resource('material', MaterialController::class);
    Route::resource('materialRate', MaterialRateController::class);
    Route::resource('materialCollection', MaterialCollectionController::class);
    Route::resource('cargoHandling', CargoHandlingController::class);
});

//report
Route::controller(ReportController::class)->prefix('report')->as('report.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('annual-progress-report', 'annualProgressReport')->name('annual-progress-report');
    Route::post('report-data', 'report')->name('report-data');
    Route::post('annual-progress-report', 'getAnnualProgressReport')->name('get-annual-progress-report');
    Route::get('consumer-committee-projects', 'consumerCommitteeProjectsPage')->name('consumer-committee-projects');
    Route::post('consumer-committee-projects', 'getConsumerCommitteeProjects')->name('consumer-committee-projects');
    Route::get('contract-projects', 'contractProjectsPage')->name('contract-projects-page');
    Route::post('contract-projects', 'getContractProjects')->name('get-contract-projects');
    Route::get('incomplete-projects', 'incompleteProjectsPage')->name('incomplete-projects');
    Route::post('incomplete-projects', 'getIncompleteProjects')->name('get-incomplete-projects');
    Route::get('price-range-report', 'priceRangeReportPage')->name('price-range-report-page');
    Route::post('price-range-report', 'getPriceRangeReportData')->name('get-price-range-report-data');
    Route::get('work-detail-report', 'workDetailReportPage')->name('work-detail-report-page');
    Route::post('work-detail-report', 'getWorkDetailReport')->name('get-work-detail-report');
});
