<?php

namespace Database\Seeders;

use App\Traits\StoreSqlInDatabaseTrait;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    use StoreSqlInDatabaseTrait;

    public function run()
    {
        $this->storeSql(storage_path('sql/Address/address.sql'));
    }
}
