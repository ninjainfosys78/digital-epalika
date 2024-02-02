<?php

use Illuminate\Support\Facades\Route;
use Modules\Roaster\Http\Controllers\AttendanceController;
use Modules\Roaster\Http\Controllers\OrganizationTrainingController;
use Modules\Roaster\Http\Controllers\TraineeTaxClearanceController;
use Modules\Roaster\Http\Controllers\TraineeUserAuthController;
use Modules\Roaster\Http\Controllers\TraineeUserDashboardController;

Route::get('dashboard', TraineeUserDashboardController::class)->name('dashboard');

Route::prefix('profile')->group(function () {
    Route::get('/', [TraineeUserAuthController::class, 'profile'])->name('auth-organization.profile');
});


Route::resource('traineeTaxClearance', TraineeTaxClearanceController::class);
Route::resource('organizationTraining', OrganizationTrainingController::class);
Route::get('training/{training}/trainee/{trainee}/showTrainee', [OrganizationTrainingController::class, 'showTrainee'])->name('trainee.showTrainee');
Route::get('training/{training}/trainee/{trainee}/editTrainee', [OrganizationTrainingController::class, 'editTrainee'])->name('trainee.editTrainee');
Route::resource('training/{training}/trainee/{trainee}/attendance', AttendanceController::class);
Route::get('training/{training}', [OrganizationTrainingController::class, 'traineeList'])->name('traineeList');
Route::put('trainee/{trainee}/updateSelectTrainee', [OrganizationTrainingController::class, 'updateSelectTrainee'])->name('trainee.updateSelectTrainee');
Route::put('technicalTrainee/{technicalTrainee}/updateSelectTrainee', [OrganizationTrainingController::class, 'updateSelectTechnicalTrainee'])->name('technicalTrainee.updateSelectTrainee');
