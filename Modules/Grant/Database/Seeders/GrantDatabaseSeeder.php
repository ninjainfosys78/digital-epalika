<?php

namespace Modules\Grant\Database\Seeders;

use Illuminate\Database\Seeder;

class GrantDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            GrantPermissionTableSeeder::class,
        ]);
    }
}
