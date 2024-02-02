<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Website\ImportantLinkController;
use App\Http\Controllers\Admin\Website\MunicipalDetailController;
use App\Http\Controllers\Admin\Website\SliderController;
use App\Http\Controllers\Admin\Website\WebsiteDashboardController;
use App\Http\Controllers\PinController;
use App\Http\Controllers\TechController;
use Illuminate\Support\Facades\Route;

Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
Route::patch('profile/update', [ProfileController::class, 'updateProfile'])->name('updateProfile');
Route::patch('password/update', [ProfileController::class, 'updatePassword'])->name('updatePassword');

Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
Route::get('dashboard/ajax', [DashboardController::class,'ajaxData'])->name('dashboard.ajax');

Route::controller(AddressController::class)->prefix('address')->as('address.')->group(function () {
    Route::get('districts', 'district')->name('districts');
    Route::get('local-bodies', 'localBodies')->name('local-bodies');
    Route::get('ward-no', 'wardNo')->name('ward-no');
});
Route::get('cache-clear', [DashboardController::class, 'cacheClear'])->name('cache-clear');
Route::get('tech-help', [TechController::class, 'index'])->name('tech');
Route::view('lock-screen', 'admin.lock_screen.lock_screen')->name('lock-screen');
Route::view('terms', 'admin.terms_and_conditions.index')->name('terms');
Route::get('fileView', [FileController::class, 'index'])->name('fileView');

//notification
Route::get('notification', [NotificationController::class, 'notification'])->name('notification');
Route::get('notification/{databaseNotification}', [NotificationController::class, 'readNotification'])->name('notification.read');
Route::get('readAllNotification', [NotificationController::class, 'readAllNotification'])->name('notification.readAllNotification');

//chunk file upload
Route::post('file-upload/chunkStore', [FileUploadController::class, 'chunkFileStore'])->name('fileUpload.chunkStore');



//file
Route::get('file/{file}/download', [FileController::class, 'download'])->name('file.download');
Route::get('file-download', [FileController::class, 'downloadFile'])->name('file-url-download');
Route::post('file-upload', [FileController::class, 'fileUpload'])->name('file-upload');
Route::get('file-manager', [FileController::class, 'getFileManager'])->name('file.get-file-manager');
Route::resource('file', FileController::class)->only('show', 'index', 'store', 'destroy');



//activity logs
Route::get('activityLog', [ActivityLogController::class, 'index'])->name('activityLog.index');

//check pin
Route::post('pin/checkPin', [PinController::class, 'checkPin'])->name('pin.check-pin');
Route::resource('pin', PinController::class);
