<?php


use Illuminate\Support\Facades\Route;
use Modules\EMap\Http\Controllers\AttachDocumentController;
use Modules\EMap\Http\Controllers\Clients\MapApplyController;
use Modules\EMap\Http\Controllers\OrganizationNotificationController;

// Route::get('dashboard', OrganizationDashboardController::class)->name('dashboard');



Route::controller(MapApplyController::class)->group(function () {
    Route::get('mapApply/{mapApply}/map-form-info', 'mapFormInfo')->name('mapFormInfo');
    Route::get('mapApply/{mapApply}/update-status-organization/{noticeTypeEnum}', 'updateStatusOrganization')->name('updateStatusOrganization');
    Route::get('mapApply/{mapApply}/update-sent-admin-status', 'updateStatus')->name('updateStatus');
    Route::get('mapApply/{mapApply}/template-data/{noticeTypeEnum}', 'getTemplateData')->name('getTemplateData');
    Route::post('mapApply/{mapApply}/storeTemplateData/{noticeTypeEnum}', 'storeTemplateData')->name('storeTemplateData');
});
Route::get('mapApply/{mapApply}/form', [MapApplyController::class, 'formList'])->name('formList');
Route::get('mapApply/{mapApply}/form/{form}/formDetail', [MapApplyController::class, 'formDetail'])->name('formDetail');
Route::resource('mapApply', MapApplyController::class);
Route::get('mapApply/{mapApply}/formDataType/{formDataType}/print', [AttachDocumentController::class, 'printTemplate'])->name('printTemplate');
Route::get('appliedDocument/{appliedDocument}', [AttachDocumentController::class, 'documentDetail'])->name('documentDetail');
Route::get('formStore/{formStore}', [AttachDocumentController::class, 'formStoreDetail'])->name('formStoreDetail');
Route::get('formDataType/{formDataType}/formStore/{formStore}/print', [AttachDocumentController::class, 'formStorePrint'])->name('formStorePrint');
Route::get('formDataType/{formDataType}/formStore/{formStore}/formStoreStatus/{formStoreStatus}/formStoreStatusPrint', [AttachDocumentController::class, 'formStoreStatusPrint'])->name('formStoreStatusPrint');
Route::resource('mapApply/{mapApply}/form/{form}/formDataType/{formDataType}/appliedDocument', AttachDocumentController::class);
Route::get('mapApply/{mapApply}/view/{form}/detail', [MapApplyController::class, 'viewDetail'])->name('organization.view-detail');
Route::put('formStore/{formStore}/uploadDocument',[MapApplyController::class,'uploadDocument'])->name('uploadFormStoreDocument');


//organization notification

Route::get('notification', [OrganizationNotificationController::class, 'notification'])->name('notification');
Route::get('notification/{databaseNotification}', [OrganizationNotificationController::class, 'readNotification'])->name('notification.read');
Route::get('readAllNotification', [OrganizationNotificationController::class, 'readAllNotification'])->name('notification.readAllNotification');

//organization document

Route::get('mapApply/{mapApply}/attachment/organizationDocument', [AttachDocumentController::class, 'index'])->name('organizationDocument');
Route::post('mapApply/{mapApply}/attachment/storeOrganizationDocument', [AttachDocumentController::class, 'storeOrganizationDocument'])->name('storeOrganizationDocument');

Route::put('appliedDocument/{appliedDocument}/updateAppliedDocumentStatus', [AttachDocumentController::class, 'updateAppliedDocumentStatus'])->name('updateAppliedDocumentStatus');
Route::put('formStore/{formStore}/updateFormStoreStatus', [AttachDocumentController::class, 'updateFormStoreStatus'])->name('updateFormStoreStatus');
Route::put('paymentStore/{paymentStore}/updatePaymentStoreStatus', [AttachDocumentController::class, 'updatePaymentStoreStatus'])->name('updatePaymentStoreStatus');
