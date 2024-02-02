<?php

use Illuminate\Support\Facades\Route;
use Modules\JudicialCommittee\Http\Controllers\Admin\Api\ComplaintRegistrationApiController;

Route::post('complaintRegistration', [ComplaintRegistrationApiController::class, 'complaintRegistration']);
Route::get('registeredComplain', [ComplaintRegistrationApiController::class, 'registeredComplain']);
