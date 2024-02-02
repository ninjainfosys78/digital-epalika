<?php

namespace Database\Seeders;

use App\Models\Settings\Units\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run()
    {
        $units = [
            [
                'title' => 'बिघा',
                'notation_ne' => 'बिघा',
                'title_en' => 'Bigha',
                'notation' => 'bigha',
                'measurement_unit_id' => 1,
                'type_id' => 1
            ],
            [
                'title' => 'कठ्ठा',
                'notation_ne' => 'कठ्ठा',
                'title_en' => 'Kattha',
                'notation' => 'kattha',
                'measurement_unit_id' => 1,
                'type_id' => 1
            ],
            [
                'title' => 'धुर',
                'notation_ne' => 'धुर',
                'title_en' => 'Dhur',
                'notation' => 'dhur',
                'measurement_unit_id' => 1,
                'type_id' => 1,
                'is_smallest' => 1
            ],
            [
                'title' => 'रोपनी',
                'notation_ne' => 'रोपनी',
                'title_en' => 'Ropani',
                'notation' => 'ropani',
                'measurement_unit_id' => 2,
                'type_id' => 1
            ],
            [
                'title' => 'आना',
                'notation_ne' => 'आना',
                'title_en' => 'Aana',
                'notation' => 'aana',
                'measurement_unit_id' => 2,
                'type_id' => 1
            ],
            [
                'title' => 'पैसा',
                'notation_ne' => 'पैसा',
                'title_en' => 'Paisa',
                'notation' => 'paisa',
                'measurement_unit_id' => 2,
                'type_id' => 1
            ],
            [
                'title' => 'दाम',
                'notation_ne' => 'दाम',
                'title_en' => 'Dam',
                'notation' => 'dam',
                'measurement_unit_id' => 2,
                'type_id' => 1,
                'is_smallest' => 1
            ],
            [
                'title' => 'वर्ग फिट',
                'notation_ne' => 'वर्ग फिट',
                'title_en' => 'square Feet',
                'notation' => 'sq.feet',
                'measurement_unit_id' => 3,
                'type_id' => 1,
                'is_smallest' => 1
            ],
            [
                'title' => 'वर्ग मीटर',
                'notation_ne' => 'वर्ग मीटर',
                'title_en' => 'square Meter',
                'notation' => 'sq.meter',
                'measurement_unit_id' => 3,
                'type_id' => 1
            ],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
