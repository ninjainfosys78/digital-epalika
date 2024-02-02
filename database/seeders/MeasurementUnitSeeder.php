<?php

namespace Database\Seeders;

use App\Models\Settings\Units\MeasurementUnit;
use Illuminate\Database\Seeder;

class MeasurementUnitSeeder extends Seeder
{
    public function run(): void
    {
        $measurementUnits = [
            ['title' => 'bigha,kathha,dhur', 'type_id' => 1],
            ['title' => 'ropani,aana,paisa,dam', 'type_id' => 1],
            ['title' => 'square feet, square meter', 'type_id' => 1],
        ];

        foreach ($measurementUnits as $measurementUnit) {
            MeasurementUnit::create($measurementUnit);
        }
    }
}
