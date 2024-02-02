<?php

namespace Modules\Roaster\Database\Seeders;

use Illuminate\Database\Seeder;

class RoasterDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoasterPermissionTableSeeder::class,
        ]);
    }
}
