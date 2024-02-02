<?php

use Illuminate\Support\Facades\Route;
use Modules\Recommendation\Http\Controllers\SipharishCreateApiController;

Route::get('sipharisCategory', [SipharishCreateApiController::class, 'index']);
Route::get('sipharisCategory/{sipharisCategory}', [SipharishCreateApiController::class, 'show']);
Route::get('sipharisSubCategory', [SipharishCreateApiController::class, 'subCategoryList']);
Route::get('sipharisSubCategory/{sipharisSubCategory}', [SipharishCreateApiController::class, 'subCategoryShow']);
Route::get('sipharishFormType/{sipharishFormType}', [SipharishCreateApiController::class, 'sipharishFormTypeList']);
Route::post('sipharishCreate', [SipharishCreateApiController::class, 'store']);
Route::get('sipharishCreate', [SipharishCreateApiController::class, 'sipharishCreateList']);
Route::get('sipharishCreate/{sipharishCreate}', [SipharishCreateApiController::class, 'sipharishCreateShow']);
