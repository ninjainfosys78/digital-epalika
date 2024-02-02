<?php

namespace Modules\GrievanceHandling\Database\Seeders;

use App\Traits\StorePermissionTrait;
use Illuminate\Database\Seeder;

class GrievanceHandlingPermissionTableSeeder extends Seeder
{
    use StorePermissionTrait;

    public function run()
    {
        $permissions = [
            'grievanceHandlingDashboard_access',
            'grievanceType_access',
            'grievanceType_create',
            'grievanceType_edit',
            'grievanceType_delete',
            'grievanceOffice_access',
            'grievanceOffice_create',
            'grievanceOffice_edit',
            'grievanceOffice_delete',
            'grievanceDetail_access',
            'grievanceDetail_create',
            'grievanceDetail_edit',
            'grievanceDetail_delete',
            'grievanceUser_access',
            'grievanceUser_create',
            'grievanceUser_edit',
            'grievanceUser_delete',
        ];

        $this->storePermission($permissions);
    }
}
