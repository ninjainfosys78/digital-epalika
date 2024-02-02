<?php

namespace Modules\BusinessRegistration\Database\Seeders;

use App\Traits\StorePermissionTrait;
use Illuminate\Database\Seeder;

class BusinessRegistrationPermissionTableSeeder extends Seeder
{
    use StorePermissionTrait;

    public function run()
    {
        $permissions = [
            'businessRegistrationDashboard_access',
            'objectTransaction_access',
            'objectTransaction_create',
            'objectTransaction_edit',
            'objectTransaction_delete',
            'investmentRevenue_access',
            'investmentRevenue_create',
            'investmentRevenue_edit',
            'investmentRevenue_delete',
            'businessNature_access',
            'businessNature_create',
            'businessNature_edit',
            'businessNature_delete',
            'businessPurpose_access',
            'businessPurpose_create',
            'businessPurpose_edit',
            'businessPurpose_delete',
            'businessRegistrationTemplate_access',
            'businessRegistrationTemplate_create',
            'businessRegistrationTemplate_edit',
            'businessRegistrationTemplate_delete',
            'businessRegistration_access',
            'businessRegistration_create',
            'businessRegistration_edit',
            'businessRegistration_delete',
            'businessRegistrationPrint_access',
            'customs_edit',
            'businessRenew_access',
            'businessRenew_create',
            'businessRenew_edit',
            'businessRenew_delete',
        ];

        $this->storePermission($permissions);
    }
}
