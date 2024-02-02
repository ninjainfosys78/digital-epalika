<?php

namespace Modules\TaskManagement\Database\Seeders;

use Illuminate\Database\Seeder;

class TaskManagementDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            TaskManagementPermissionSeederTableSeeder::class,
        ]);
    }
}
