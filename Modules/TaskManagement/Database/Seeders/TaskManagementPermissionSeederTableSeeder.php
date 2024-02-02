<?php

namespace Modules\TaskManagement\Database\Seeders;

use App\Traits\StorePermissionTrait;
use Illuminate\Database\Seeder;

class TaskManagementPermissionSeederTableSeeder extends Seeder
{
    use StorePermissionTrait;

    public function run()
    {
        $permissions = [
            'taskManagementDashboard_access',
            'taskActivity_access',
            'taskActivity_create',
            'taskActivity_edit',
            'taskActivity_delete',
            'allTaskActivity_access',
            'fileTracking_access',
            'fileTracking_create',
            'fileTracking_edit',
            'fileTracking_delete',
        ];

        $this->storePermission($permissions);
    }
}
