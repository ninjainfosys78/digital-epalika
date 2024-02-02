<?php

use Illuminate\Support\Facades\Route;
use Modules\Roaster\Http\Controllers\TraineeApiController;

Route::get('training', [TraineeApiController::class, 'training']);
Route::get('training/{training}', [TraineeApiController::class, 'show']);
Route::get('traineeSetting', [TraineeApiController::class, 'traineeSetting']);
