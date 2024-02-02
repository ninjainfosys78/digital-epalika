<?php

namespace Modules\GrievanceHandling\Database\Seeders;

use Illuminate\Database\Seeder;

class GrievanceHandlingDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            GrievanceHandlingPermissionTableSeeder::class,
            GrievanceSettingTableSeeder::class,
        ]);
    }
}
