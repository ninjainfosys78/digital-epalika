<?php

use Illuminate\Support\Facades\Route;
use Modules\DigitalBoard\Http\Controllers\Admin\AudioController;
use Modules\DigitalBoard\Http\Controllers\Admin\CitizenCharterController;
use Modules\DigitalBoard\Http\Controllers\Admin\DashboardController;
use Modules\DigitalBoard\Http\Controllers\Admin\NoticeController;
use Modules\DigitalBoard\Http\Controllers\Admin\PopUpNoticeController;
use Modules\DigitalBoard\Http\Controllers\Admin\PhotoGalleryController;
use Modules\DigitalBoard\Http\Controllers\Admin\ServiceController;
use Modules\DigitalBoard\Http\Controllers\Admin\ServiceEmployeeController;
use Modules\DigitalBoard\Http\Controllers\Admin\VideoController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/ajax', [DashboardController::class, 'ajaxData'])->name('dashboard.ajax');
Route::resource('video', VideoController::class);
Route::resource('{type}/notice', NoticeController::class);
Route::get('{type}/notice/{notice}/noticeUpdate', [NoticeController::class, 'updateClosedDate'])->name('notice.updateClosedDate');
Route::get('{type}/notice/{notice}/updateShowOnIndex', [NoticeController::class, 'updateShowOnIndex'])->name('notice.updateShowOnIndex');
Route::resource('popUpNotice', PopUpNoticeController::class);
Route::get('popUpNotice/{popUpNotice}/updateShowOnIndex', [PopUpNoticeController::class, 'updateShowOnIndex'])->name('popUpNotice.updateShowOnIndex');



Route::resource('service', ServiceController::class);
Route::resource('service/{service}/serviceEmployee', ServiceEmployeeController::class)->names('service.serviceEmployee');

Route::resource('citizenCharter', CitizenCharterController::class);
Route::resource('photoGallery', PhotoGalleryController::class);
Route::resource('audio', AudioController::class);
