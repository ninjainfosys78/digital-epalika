<?php

namespace Modules\BusinessRegistration\Database\Seeders;

use Illuminate\Database\Seeder;

class BusinessRegistrationDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            BusinessRegistrationPermissionTableSeeder::class,
        ]);
    }
}
