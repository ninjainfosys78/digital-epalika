<?php

use App\Http\Controllers\Admin\LandInvoiceController;
use Illuminate\Support\Facades\Route;
use Modules\Plan\Http\Controllers\Admin\Setting\RevenueSettingController;
use Modules\Revenue\Http\Controllers\Admin\DashboardController;
use Modules\Revenue\Http\Controllers\Admin\InvoiceController;
use Modules\Revenue\Http\Controllers\Admin\PhysicalStructureTypeController;
use Modules\Revenue\Http\Controllers\Admin\PlaceController;
use Modules\Revenue\Http\Controllers\Admin\RevenueCategoryController;
use Modules\Revenue\Http\Controllers\Admin\RevenueController;
use Modules\Revenue\Http\Controllers\Admin\SectorController;
use Modules\Revenue\Http\Controllers\Admin\StructureAssessmentRateController;
use Modules\Revenue\Http\Controllers\Admin\TaxPayerController;
use Modules\Revenue\Http\Controllers\Admin\TaxPayerLandController;
use Modules\Revenue\Http\Controllers\Admin\TaxPayerTypeController;
use Modules\Revenue\Http\Controllers\ReportController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/ajax', [DashboardController::class, 'ajaxData'])->name('dashboard.ajax');

Route::get('taxPayer/{taxPayer}/update-status', [TaxPayerController::class, 'updateStatus'])->name('taxPayer.update-status');
Route::resource('taxPayer/{taxPayer}/taxPayerLand', TaxPayerLandController::class)->names('taxPayer.taxPayerLand');

Route::resource('taxPayer', TaxPayerController::class);

Route::resource('land/invoice', LandInvoiceController::class)->names('land.invoice');

Route::resource('invoice', InvoiceController::class);

Route::prefix('setting')->as('setting.')->group(function () {
    Route::get('/', [RevenueSettingController::class, 'index'])->name('index');
    Route::post('/', [RevenueSettingController::class, 'store'])->name('store');
    Route::resource('revenue-category', RevenueCategoryController::class)->except('show');

    Route::get('revenue/{revenue}/update-status', [RevenueController::class, 'updateStatus'])->name('revenue.update-status');
    Route::resource('revenue', RevenueController::class)->except('show');

    Route::resource('taxPayerType', TaxPayerTypeController::class)->except('show');
    Route::resource('structureAssessmentRate', StructureAssessmentRateController::class)->except('show');
    Route::resource('physicalStructureType', PhysicalStructureTypeController::class)->except('show');
    Route::resource('sector', SectorController::class)->except('show');
    Route::resource('place', PlaceController::class)->except('show');
});

Route::prefix('report')->as('report.')->controller(ReportController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('report', 'report')->name('report-data');
    Route::get('invoice', 'invoice')->name('invoice');
    Route::post('invoice-report', 'invoiceReport')->name('invoice-report');
    Route::get('tax-payer', 'taxPayer')->name('tax-payer');
    Route::post('tax-payer-report', 'taxPayerReport')->name('tax-payer-report');
    Route::get('word-wise-invoice', 'wordWiseInvoice')->name('word-wise-invoice');
    Route::post('word-wise-invoice-report', 'wordWiseInvoiceReport')->name('word-wise-invoice-report');
});
