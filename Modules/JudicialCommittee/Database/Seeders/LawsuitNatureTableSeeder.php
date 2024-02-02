<?php

namespace Modules\JudicialCommittee\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\JudicialCommittee\Entities\LawsuitNature;

class LawsuitNatureTableSeeder extends Seeder
{
    public function run()
    {
        $lawsuitNatures = [
            ['title' => 'देवानी प्रकृति', 'title_en' => 'Civil', 'code' => 'CP'],
            ['title' => 'फौजदारी प्रकृति', 'title_en' => 'Criminal', 'code' => 'CR']
        ];

        foreach ($lawsuitNatures as $lawsuitNature) {
            LawsuitNature::create($lawsuitNature);
        }
    }
}
