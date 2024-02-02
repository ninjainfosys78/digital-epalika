<?php

use Illuminate\Support\Facades\Route;
use Modules\Roaster\Http\Controllers\Admin\Api\PublicApiController;

Route::get('training', [PublicApiController::class, 'training']);
Route::get('allTraining', [PublicApiController::class, 'allTraining']);
// Route::get('allTraining/{trainingType}', [PublicApiController::class, 'allTraining'])
// ->name('api-public.technical_trainee')
// ->whereIn('allTraining', ['trainee', 'technical_trainee']);
