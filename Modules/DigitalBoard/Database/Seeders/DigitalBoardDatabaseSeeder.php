<?php

namespace Modules\DigitalBoard\Database\Seeders;

use Illuminate\Database\Seeder;

class DigitalBoardDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            DigitalBoardPermissionTableSeeder::class,
        ]);
    }
}
