<?php

namespace Modules\JudicialCommittee\Database\Seeders;

use Illuminate\Database\Seeder;

class JudicialCommitteeDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            JudicialPermissionTableSeeder::class,
            LawsuitNatureTableSeeder::class
        ]);
    }
}
