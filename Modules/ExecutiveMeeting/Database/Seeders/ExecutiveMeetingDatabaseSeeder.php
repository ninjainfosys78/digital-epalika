<?php

namespace Modules\ExecutiveMeeting\Database\Seeders;

use Illuminate\Database\Seeder;

class ExecutiveMeetingDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CommitteeTypeTableSeeder::class,
            ExecutiveMeetingPermissionTableSeeder::class,
        ]);
    }
}
