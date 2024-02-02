<?php

namespace Database\Seeders;

use App\Models\Settings\OfficeSetting;
use Illuminate\Database\Seeder;

class OfficeSettingSeeder extends Seeder
{
    public function run()
    {
        OfficeSetting::create([
            'name' => 'text',
            'logo' => null,
            'logo1' => null,
            'logo2' => null,
            'background_image' => null,
            'google_map' => null,
            'province_id' => null,
            'district_id' => null,
            'local_body_id' => null,
            'ward_no' => null,
            'phone' => null,
            'email' => null,
            'website' => null,
            'facebook_link' => null,
        ]);
    }
}
