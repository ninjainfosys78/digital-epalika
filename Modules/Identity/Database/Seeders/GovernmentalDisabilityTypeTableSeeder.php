<?php

namespace Modules\Identity\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Modules\Identity\Entities\GovernmentalDisabilityType;

class GovernmentalDisabilityTypeTableSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        GovernmentalDisabilityType::truncate();
        Schema::enableForeignKeyConstraints();

        $governmentalDisabilityTypes = [
            ['title' => 'पूर्ण अशक्त अपाङ्गता','title_en' => 'Profound Disability','color' => '#FF0000','category' => 'A','position' => null,'header_color' => '#FF0000','font_color' => '#FF0000','raven_background' => '#FF0000'],
            ['title' => 'अति अशक्त अपाङ्गता','title_en' => 'Severe Disability','color' => '#0000FF','category' => 'B','position' => null,'header_color' => '#0000FF','font_color' => '#0000FF','raven_background' => '#0000FF'],
            ['title' => 'मध्यम अपाङ्गता','title_en' => 'Moderate Disability','color' => '#FFFF00','category' => 'C','position' => null,'header_color' => '#FFFF00','font_color' => '#FFFF00','raven_background' => '#FFFF00'],
            ['title' => 'सामान्य अपाङ्गता','title_en' => 'Mild Disability','color' => '#FFFFFF','category' => 'D','position' => null,'header_color' => '#FFFFFF','font_color' => '#FFFFFF','raven_background' => '#FFFFFF'],

        ];

        foreach ($governmentalDisabilityTypes as $governmentalDisabilityType) {
            GovernmentalDisabilityType::create($governmentalDisabilityType);
        }
    }
}
