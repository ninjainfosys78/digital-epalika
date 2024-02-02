<?php

namespace Database\Seeders;

use App\Models\Ethnicity;
use Illuminate\Database\Seeder;

class EthnicitySeeder extends Seeder
{
    public function run()
    {
        $ethnicities = [
            ['title' => 'क्षेत्री'],
            ['title' => 'बाहुन'],
            ['title' => 'मगर'],
            ['title' => 'थारू'],
            ['title' => 'तामाङ'],
            ['title' => 'नेवार'],
        ];

        foreach ($ethnicities as $ethnicity) {
            Ethnicity::create($ethnicity);
        }
    }
}
