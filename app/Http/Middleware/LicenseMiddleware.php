<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Installer\LicenseController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LicenseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Cache::has('license')) {
            if (file_exists(config_path('license.php'))) {
                Cache::remember('license', 60 * 60 * 12, function () {
                    $license = config('license.license_key');
                    $domain = request()->getUri();
                    return (new LicenseController())->checkLicense($license, $domain);
                });
            } else {
                Cache::remember('licenseError', 60 * 60 * 12, fn () => 'License key not found');
            }
        }
        return $next($request);
    }
}
