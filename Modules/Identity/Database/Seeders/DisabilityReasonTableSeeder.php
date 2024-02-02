<?php

namespace Modules\Identity\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Identity\Entities\DisabilityReason;

class DisabilityReasonTableSeeder extends Seeder
{
    public function run()
    {
        $disabilityReasons = [
            ['title' => 'सशस्त्र द्वन्द्व'],
            ['title' => 'जन्मजात'],
            ['title' => 'रोगको दीर्घ असर'],
            ['title' => 'दुुर्घटना'],
        ];

        foreach ($disabilityReasons as $disabilityReason) {
            DisabilityReason::create($disabilityReason);
        }
    }
}
