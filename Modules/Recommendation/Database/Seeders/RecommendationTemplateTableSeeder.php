<?php

namespace Modules\Recommendation\Database\Seeders;

use App\Traits\StoreSqlInDatabaseTrait;
use Illuminate\Database\Seeder;

class RecommendationTemplateTableSeeder extends Seeder
{
    use StoreSqlInDatabaseTrait;
    public function run()
    {
        $this->storeSql(storage_path('sql/Recommendation/recommendation_templates.sql'));
    }
}
