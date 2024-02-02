<?php

use Illuminate\Support\Facades\Route;
use Modules\GrievanceHandling\Http\Controllers\Admin\GrievanceApiFormController;

Route::post('grievance', [GrievanceApiFormController::class, 'grievance']);
Route::get('getMobileUserGrievance', [GrievanceApiFormController::class, 'getMobileUserGrievance']);
