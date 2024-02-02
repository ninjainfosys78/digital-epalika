<?php

namespace Database\Seeders;

use App\Models\Settings\Units\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        Type::create([
            'title' => 'Land Measurement',
        ]);
    }
}
