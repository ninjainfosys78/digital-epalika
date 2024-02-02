<?php

namespace Modules\Identity\Database\Seeders;

use Illuminate\Database\Seeder;

class IdentityDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            IdentityPermissionTableSeeder::class,
            DisabilityReasonTableSeeder::class,
            DisabilityTypeTableSeeder::class,
            CardColorTableSeeder::class,
            GovernmentalDisabilityTypeTableSeeder::class,
        ]);
    }
}
