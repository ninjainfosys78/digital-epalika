<?php

use Illuminate\Support\Facades\Route;
use Modules\Roaster\Http\Controllers\FrontendController;
use Modules\Roaster\Http\Controllers\TraineeUserAuthController;

Route::prefix('traineeUser')->as('traineeUser.')->group(function () {
    Route::get('login', [TraineeUserAuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('login', [TraineeUserAuthController::class, 'Login'])->name('login');
    Route::post('logout', [TraineeUserAuthController::class, 'logout'])->name('logout');
    Route::get('{traineeUser}/invitation', [TraineeUserAuthController::class, 'invitation'])->name('invitation');
    Route::get('password/create', [TraineeUserAuthController::class, 'create'])->name('password.create')->middleware(['password.check']);
    Route::post('password/store', [TraineeUserAuthController::class, 'store'])->name('password.store')->middleware(['password.check']);
});
Route::get('/', [FrontendController::class, 'index'])->name('index');

Route::get('trainer-form', [FrontendController::class, 'trainerForm'])->name('trainer-form');
Route::get('application', [FrontendController::class, 'application'])->name('application');
Route::get('open/trainings/{trainingType}', [FrontendController::class, 'individualTrainingView'])->name('individual-training-view');
Route::get('training/{training}/farmer', [FrontendController::class, 'traineeForm'])->name('traineeForm');
Route::get('training/{training}/technical-trainee', [FrontendController::class, 'technicalTraineeForm'])->name('technicalTraineeForm');
Route::get('trainee-register', [FrontendController::class, 'traineeRegister'])->name('trainee-register');
