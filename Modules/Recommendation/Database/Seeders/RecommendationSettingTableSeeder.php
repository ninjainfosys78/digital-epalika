<?php

namespace Modules\Recommendation\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Recommendation\Entities\RecommendationSetting;

class RecommendationSettingTableSeeder extends Seeder
{
    public function run()
    {
        RecommendationSetting::create([
            'ward_chairman_id' => null,
            'ward_secretary_id' => null,
            'ward_no' => null,
            'user_id' => null,
        ]);
    }
}
