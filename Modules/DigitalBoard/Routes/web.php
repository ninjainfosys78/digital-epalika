<?php

use Modules\DigitalBoard\Http\Controllers\FrontController;

Route::get('service/{service}', [FrontController::class, 'showServiceDetail'])->name('service.view');

Route::controller(FrontController::class)->group(function () {
    Route::get('helpdesk', 'helpDesk')->name('helpdesk.helpdesk');
    Route::get('service', 'service')->name('service');
    Route::get('getServices/{id?}', 'getServices')->name('getServices');
});
