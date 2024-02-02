<?php

namespace Modules\Circular\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Circular\Entities\CircularSetting;

class CircularSettingTableSeeder extends Seeder
{
    public function run()
    {
        CircularSetting::create([
            'registration_prefix' => 'R-',
            'dispatch_prefix' => 'D-',
            'registration_number' => 0,
            'dispatch_number' => 0,
        ]);
    }
}
