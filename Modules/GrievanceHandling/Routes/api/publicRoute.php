<?php

use Illuminate\Support\Facades\Route;
use Modules\GrievanceHandling\Http\Controllers\Admin\GrievanceApiFormController;

Route::get('grievanceFormSetting', [GrievanceApiFormController::class, 'grievanceFormSetting']);
