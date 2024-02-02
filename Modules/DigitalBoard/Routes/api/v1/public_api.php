<?php

use Illuminate\Support\Facades\Route;
use Modules\DigitalBoard\Http\Controllers\Api\v1\PublicApiController;

Route::get('employee', [PublicApiController::class, 'employee'])->name('api-public.employee');
Route::get('publicRepresentative', [PublicApiController::class, 'publicRepresentative'])->name('api-public.public-representative');

Route::get('notice/{notice}', [PublicApiController::class, 'showNotice'])->name('api-public.show-notice');
Route::get('latestNews', [PublicApiController::class, 'latestNews'])->name('api-public.latestNews');
Route::get('marqueNews', [PublicApiController::class, 'marqueNews'])->name('api-public.marqueNews');
Route::get('popUpNotice', [PublicApiController::class, 'popUpNotice'])->name('api-public.popUpNotice');
Route::get('notice', [PublicApiController::class, 'notice'])->name('api-public.notice');
Route::get('news', [PublicApiController::class, 'news'])->name('api-public.news');
Route::get('photoGallery', [PublicApiController::class, 'photoGallery'])->name('api-public.photoGallery');
Route::get('audio', [PublicApiController::class, 'audio'])->name('api-public.audio');
Route::get('employee/{employeeType}', [PublicApiController::class, 'representative'])
->name('api-public.representative')
->whereIn('employeeType', ['employee', 'representative']);

Route::get('branch/{branch}/service', [PublicApiController::class, 'getBranchService'])->name('api-public.get-branch-service');
Route::get('branch/{branch}', [PublicApiController::class, 'getBranchDetail'])->name('api-public.detail-branch-get');
Route::get('branch', [PublicApiController::class, 'branch'])->name('api-public.branch');

Route::get('service', [PublicApiController::class, 'getAllService'])->name('api-public.get-all-service');

Route::get('video', [PublicApiController::class, 'video'])->name('api-public.video');
