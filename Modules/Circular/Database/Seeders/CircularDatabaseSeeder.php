<?php

namespace Modules\Circular\Database\Seeders;

use Illuminate\Database\Seeder;

class CircularDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CircularPermissionTableSeeder::class,
            CircularSettingTableSeeder::class,
        ]);
    }
}
