<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Recommendation\Http\Controllers\Admin\Api\v1\SifarishApicontroller;

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

Route::middleware('auth:api')->get('/recommendation', function (Request $request) {
    return $request->user();
});

Route::resource('sifarish', SifarishApicontroller::class);
