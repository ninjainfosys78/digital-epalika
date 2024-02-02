<?php

use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class,'login'])->name('api.login');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('file/store-in-storage', [FileController::class, 'storeInStorage'])
    ->name('file.store-in-storage');
Route::resource('file', FileController::class)->only('show', 'index', 'store', 'destroy')->names('api.file');
