<?php

namespace Database\Seeders;

use App\Models\Settings\Relationship;
use Illuminate\Database\Seeder;

class RelationshipTableSeeder extends Seeder
{
    public function run()
    {
        $relationships = [
            ['title' => 'अन्य'],
            ['title' => 'श्रीमान/ श्रीमति'],
            ['title' => 'दाजु / भाई'],
            ['title' => 'बुबा'],
            ['title' => 'आमा'],
        ];

        foreach ($relationships as $relationship) {
            Relationship::create($relationship);
        }
    }
}
