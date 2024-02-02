<?php

namespace App\Installer;

use Illuminate\Support\Facades\DB;

trait MigrationsHelper
{
    public function getMigrations()
    {
        $migrations = glob(database_path().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.'*.php');

        return str_replace('.php', '', $migrations);
    }

    public function getExecutedMigrations()
    {
        // migrations table should exist, if not, user will receive an error.
        return DB::table('migrations')->get()->pluck('migration');
    }
}
