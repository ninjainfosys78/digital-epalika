<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\GrievanceHandling\Http\Controllers\Frontend\FrontendController;

Route::get('single-grievance', [FrontendController::class, 'singleGrievance'])->name('single-grievance');

Route::controller(FrontendController::class)->group(function () {
    Route::get('grievance', 'grievanceHandling')->name('grievance');
    Route::get('policy', 'policy')->name('policy');
    Route::get('register', 'register')->name('grievance-register');
    Route::get('public-grievance', 'publicGrievance')->name('public-grievance');
    Route::get('grievance-list', 'grievanceList')->name('grievance-list');
    Route::get('track', 'track')->name('track');
    Route::post('grievanceDetail/{grievanceDetail}/reply', 'replyGrievance')->name('replyGrievance');
});
