<?php

namespace App\Http\Controllers\Installer;

use App\Http\Controllers\Controller;
use App\Installer\DatabaseManager;

class DatabaseController extends Controller
{
    private DatabaseManager $databaseManager;
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }
    public function database()
    {
        $response = $this->databaseManager->migrateAndSeed();

        return redirect(route('installer.final'))->with(['message' => $response]);
    }
}
