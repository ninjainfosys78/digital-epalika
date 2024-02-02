<?php

namespace Modules\ListRegistration\Database\Seeders;

use Illuminate\Database\Seeder;

class ListRegistrationDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
           ListRegistrationPermissionTableSeeder::class
        ]);
    }
}
