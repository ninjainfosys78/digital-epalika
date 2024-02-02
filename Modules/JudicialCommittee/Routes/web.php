<?php

use Illuminate\Support\Facades\Route;
use Modules\JudicialCommittee\Http\Controllers\Frontend\FrontendController;

Route::get('/complainRegistration', [FrontendController::class, 'complaintApplication'])->name('complainRegistration');
