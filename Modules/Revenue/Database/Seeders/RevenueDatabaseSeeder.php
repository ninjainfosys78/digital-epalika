<?php

namespace Modules\Revenue\Database\Seeders;

use Illuminate\Database\Seeder;

class RevenueDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RevenuePermissionSeeder::class,
        ]);
    }
}
