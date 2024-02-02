<?php

namespace Modules\Plan\Database\Seeders;

use App\Traits\StoreSqlInDatabaseTrait;
use Illuminate\Database\Seeder;

class PlanTemplateTableSeeder extends Seeder
{
    use StoreSqlInDatabaseTrait;
    public function run()
    {
        $this->storeSql(storage_path('sql/plan/plan_templates.sql'));
    }
}
