<?php

use Illuminate\Support\Facades\Route;
use Modules\Roaster\Http\Controllers\DashboardController;
use Modules\Roaster\Http\Controllers\ReportController;
use Modules\Roaster\Http\Controllers\Setting\SubjectController;
use Modules\Roaster\Http\Controllers\TechnicalTraineeController;
use Modules\Roaster\Http\Controllers\TraineeController;
use Modules\Roaster\Http\Controllers\TrainerController;
use Modules\Roaster\Http\Controllers\TrainingController;
use Modules\Roaster\Http\Controllers\OrganizationController;
use Modules\Roaster\Http\Controllers\RoasterSettingController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/ajax', [DashboardController::class, 'ajaxData'])->name('dashboard.ajax');

Route::prefix('setting')->as('setting.')->group(function () {
    Route::resource('subject', SubjectController::class);
    Route::resource('roasterSetting', RoasterSettingController::class);
});

Route::resource('trainer', TrainerController::class)->except(['store', 'destroy', 'update']);
Route::put('training/{training}/update-marks', [TrainingController::class, 'updateMarks'])->name('training.update-marks');
Route::get('training/{training}/report', [TrainingController::class, 'report'])->name('training.report');
Route::get('training/{training}/update-status', [TrainingController::class, 'setFormStatus'])->name('training.set-form-status');
Route::get('training/{training}/marks', [TrainingController::class, 'marks'])->name('training.marks');
Route::put('training/{training}/update-photo', [TrainingController::class, 'storePhotos'])->name('training.store-photos');
Route::get('training/{training}/pdf', [TrainingController::class, 'pdfExport'])->name('training.pdfExport');
Route::get('training/{training}/excelExport', [TrainingController::class, 'excelExport'])->name('training.excelReport');
Route::post('training/{training}/trainee/{trainee}/updateSelectTrainee', [TrainingController::class, 'updateSelectTrainee'])->name('trainee.updateSelectTraineeStatus');
Route::resource('training', TrainingController::class);

//trainee
Route::get('trainee/{trainee}/updateSelectTrainee', [TraineeController::class, 'updateSelectTrainee'])->name('trainee.updateSelectTrainee');
Route::resource('trainee', TraineeController::class)->only(['updateSelectTrainee', 'show', 'edit']);

//technical Trainee
Route::get('technicalTrainee/{technicalTrainee}/updateSelectTechnicalTrainee', [TechnicalTraineeController::class, 'updateSelectTechnicalTrainee'])->name('technicalTrainee.updateSelectTrainee');
Route::resource('technicalTrainee', TechnicalTraineeController::class)->only(['updateSelectTechnicalTrainee', 'show', 'edit']);


Route::controller(ReportController::class)->prefix('report')->as('report.')->group(function () {
    Route::get('/', 'getRequiredData')->name('report');
    Route::post('report-data', 'report')->name('report-data');
});

Route::resource('organization', OrganizationController::class)->only('index');
Route::delete('traineeUser/{traineeUser}', [OrganizationController::class, 'destroy'])->name('organization.destroy');
Route::get('traineeUser/{traineeUser}', [OrganizationController::class, 'show'])->name('organization.show');
Route::get('traineeUser/{traineeUser}/updateLoginStatus', [OrganizationController::class, 'updateLoginStatus'])->name('organization.update-login-status');
