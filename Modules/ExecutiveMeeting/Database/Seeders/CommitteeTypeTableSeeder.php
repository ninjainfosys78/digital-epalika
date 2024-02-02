<?php

namespace Modules\ExecutiveMeeting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\ExecutiveMeeting\Entities\CommitteeType;

class CommitteeTypeTableSeeder extends Seeder
{
    public function run()
    {
        $committeeTypes = [
            ['name' => 'नगरसभा/गाउँसभा वैठक', 'committee_no' => 1],
            ['name' => 'कार्यपालिकाको बैठक', 'committee_no' => 1],
            ['name' => 'विषयगत समितिको बैठक', 'committee_no' => 6],
            ['name' => 'वडा समिति बैठक', 'committee_no' => null],
            ['name' => 'अन्य समिति बैठक', 'committee_no' => null],
        ];

        foreach ($committeeTypes as $committeeType) {
            CommitteeType::create($committeeType);
        }
    }
}
