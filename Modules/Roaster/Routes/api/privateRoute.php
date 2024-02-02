<?php

use Illuminate\Support\Facades\Route;
use Modules\Roaster\Http\Controllers\TraineeApiController;

Route::post('training/{training}', [TraineeApiController::class, 'store']);
