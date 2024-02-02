<?php

use Modules\BusinessRegistration\Http\Controllers\Api\PublicApiController;

Route::get('businessRegistrationSetting', [PublicApiController::class, 'businessRegistrationSetting'])
    ->name('business-registration-setting');
