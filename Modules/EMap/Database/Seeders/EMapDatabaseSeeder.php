<?php

namespace Modules\EMap\Database\Seeders;

use Illuminate\Database\Seeder;

class EMapDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            EMapPermissionTableSeeder::class,
        ]);
    }
}
