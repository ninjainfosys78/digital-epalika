<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            EthnicitySeeder::class,
            TypeSeeder::class,
            MeasurementUnitSeeder::class,
            UnitSeeder::class,
            AddressSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            OfficeSettingSeeder::class,
            FeatureActivationSeeder::class,
            LetterHeadTableSeeder::class,
            RelationshipTableSeeder::class
        ]);
    }
}
