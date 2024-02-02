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
use Modules\BusinessRegistration\Http\Controllers\Frontend\FrontendController;

//frontendController

Route::get('/business', [FrontendController::class, 'business'])->name('business');
Route::get('/businessDetail/{businessDetail}/detail/print', [FrontendController::class, 'printDetail'])->name('detail.print');
//Route::get('/proprietorDetail/{proprietorDetail}/print',[FrontendController::class,'printPdf'])->name('print');
Route::view('schedule', 'businessregistration::frontend.schedule.schedule_1')->name('schedule_1');
Route::view('schedule_2', 'businessregistration::frontend.schedule.schedule_2')->name('schedule_2');
Route::view('schedule_3', 'businessregistration::frontend.schedule.schedule_3')->name('schedule_3');
