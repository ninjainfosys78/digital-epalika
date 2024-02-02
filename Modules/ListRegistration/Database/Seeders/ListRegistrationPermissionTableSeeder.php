<?php

namespace Modules\ListRegistration\Database\Seeders;

use App\Traits\StorePermissionTrait;
use Illuminate\Database\Seeder;

class ListRegistrationPermissionTableSeeder extends Seeder
{
    use StorePermissionTrait;

    public function run()
    {
        $permissions = [
            'listRegistrationDashboard_access',
            'listRegistration_access',
            'listRegistration_create',
            'listRegistration_edit',
            'listRegistration_delete',
        ];

        $this->storePermission($permissions);
    }
}
