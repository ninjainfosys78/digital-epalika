<?php

namespace Modules\Circular\Database\Seeders;

use App\Traits\StorePermissionTrait;
use Illuminate\Database\Seeder;

class CircularPermissionTableSeeder extends Seeder
{
    use StorePermissionTrait;

    public function run()
    {
        $permissions = [
            'circularDashboard_access',
            'registration_access',
            'registration_create',
            'registration_edit',
            'registration_delete',
            'dispatch_access',
            'dispatch_create',
            'dispatch_edit',
            'dispatch_delete',
        ];

        $this->storePermission($permissions);
    }
}
