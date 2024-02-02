<?php

use Illuminate\Support\Facades\Route;
use Modules\JudicialCommittee\Http\Controllers\Admin\Api\ComplaintRegistrationApiController;

Route::get('complaintRegistrationSetting', [ComplaintRegistrationApiController::class, 'complaintRegistrationSetting']);
