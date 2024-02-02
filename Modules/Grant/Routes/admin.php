<?php

use Illuminate\Support\Facades\Route;
use Modules\Grant\Http\Controllers\Admin\CashGrantController;
use Modules\Grant\Http\Controllers\Admin\CooperativeController;
use Modules\Grant\Http\Controllers\Admin\DashboardController;
use Modules\Grant\Http\Controllers\Admin\EnterprisesController;
use Modules\Grant\Http\Controllers\Admin\FarmerController;
use Modules\Grant\Http\Controllers\Admin\GrantController;
use Modules\Grant\Http\Controllers\Admin\GrantDetailController;
use Modules\Grant\Http\Controllers\Admin\GroupController;
use Modules\Grant\Http\Controllers\Admin\Report\CooperativeReportController;
use Modules\Grant\Http\Controllers\Admin\Report\EnterpriseReportController;
use Modules\Grant\Http\Controllers\Admin\Report\FarmerReportController;
use Modules\Grant\Http\Controllers\Admin\Report\GrantReportController;
use Modules\Grant\Http\Controllers\Admin\Report\GroupReportController;
use Modules\Grant\Http\Controllers\Admin\Setting\AffiliationController;
use Modules\Grant\Http\Controllers\Admin\Setting\CooperativeTypeController;
use Modules\Grant\Http\Controllers\Admin\Setting\EnterpriseTypeController;
use Modules\Grant\Http\Controllers\Admin\Setting\GrantProgramController;
use Modules\Grant\Http\Controllers\Admin\Setting\GrantOfficeController;
use Modules\Grant\Http\Controllers\Admin\Setting\GrantTypeController;
use Modules\Grant\Http\Controllers\Admin\Setting\HelplessnessTypeController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/ajax', [DashboardController::class, 'ajaxData'])->name('dashboard.ajax');

Route::prefix('setting')->as('setting.')->group(function () {
    Route::resource('grantType', GrantTypeController::class);
    Route::resource('enterpriseType', EnterpriseTypeController::class);
    Route::resource('affiliation', AffiliationController::class);
    Route::resource('cooperativeType', CooperativeTypeController::class);
    Route::resource('grantProgram', GrantProgramController::class);
    Route::resource('grantOffice', GrantOfficeController::class);
    Route::resource('helplessnessType', HelplessnessTypeController::class);
});

Route::prefix('grantee')->group(function () {
    Route::get('farmer/{farmer}/grantDetails', [FarmerController::class, 'grantDetails'])->name('farmer.grantDetails');
    Route::resource('farmer', FarmerController::class);
    Route::get('group/{group}/grantDetails', [GroupController::class, 'grantDetails'])->name('group.grantDetails');
    Route::resource('group', GroupController::class);
    Route::get('cooperative/{cooperative}/grantDetails', [CooperativeController::class, 'grantDetails'])->name('cooperative.grantDetails');
    Route::resource('cooperative', CooperativeController::class);
    Route::get('enterprise/{enterprise}/grantDetails', [EnterprisesController::class, 'grantDetails'])->name('enterprise.grantDetails');
    Route::resource('enterprise', EnterprisesController::class);
});
Route::get('grant/{grant}/grantDetails', [GrantController::class, 'grantDetails'])->name('grant.grantDetails');
Route::resource('grant', GrantController::class);
Route::get('grantDetail/grant/check', [GrantDetailController::class, 'checkGrant'])->name('grantDetail.check');
Route::resource('grantDetail', GrantDetailController::class);

Route::controller(FarmerReportController::class)->prefix('report/farmer')->as('report.farmer.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('report-data', 'report')->name('report-data');
});

Route::controller(GrantReportController::class)
    ->prefix('report/grant')->as('report.grant.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('report-data', 'report')->name('report-data');

        Route::get('program-report', 'programReport')->name('program-report');
        Route::post('show-program-report', 'showProgramReport')->name('show-program-report');
    });

Route::controller(GroupReportController::class)->prefix('report/group')->as('report.group.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('report-data', 'report')->name('report-data');
});

Route::controller(EnterpriseReportController::class)->prefix('report/enterprise')->as('report.enterprise.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('report-data', 'report')->name('report-data');
});

Route::controller(CooperativeReportController::class)->prefix('report/cooperative')->as('report.cooperative.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('report-data', 'report')->name('report-data');
});


Route::resource('cashGrant', CashGrantController::class);
