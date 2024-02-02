<?php

namespace Modules\Recommendation\Database\Seeders;

use Illuminate\Database\Seeder;

class RecommendationDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RecommendationPermissionTableSeeder::class,
            RecommendationTemplateTableSeeder::class,
            RecommendationSettingTableSeeder::class
        ]);
    }
}
