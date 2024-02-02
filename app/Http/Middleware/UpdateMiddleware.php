<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UpdateMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $canInstall = new InstallMiddleware();

        // if the application has not been installed,
        // redirect to the installer
        if (!$canInstall->alreadyInstalled()) {
            return redirect()->route('LaravelInstaller::welcome');
        }

        if ($this->alreadyUpdated()) {
            abort(404);
        }
        return $next($request);
    }

    public function alreadyUpdated(): bool
    {
        $migrations = $this->getMigrations();
        $dbMigrations = $this->getExecutedMigrations();

        // If the count of migrations and dbMigrations is equal,
        // then the update as already been updated.
        if (count($migrations) == count($dbMigrations)) {
            return true;
        }

        // Continue, the app needs an update
        return false;
    }
}
