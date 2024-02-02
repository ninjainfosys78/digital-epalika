<?php

namespace Modules\Identity\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Identity\Entities\CardColor;

class CardColorTableSeeder extends Seeder
{
    public function run()
    {
        $cardColors = [
            ['title' => 'क','color' => '#FF0000'],
            ['title' => 'ख','color' => '#0000FF'],
            ['title' => 'ग','color' => '#FFFF00'],
            ['title' => 'घ','color' => '#FFFFFF'],
        ];

        foreach ($cardColors as $cardColor) {
            CardColor::create($cardColor);
        }
    }
}
