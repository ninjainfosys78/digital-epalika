<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/admin/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware(['api', 'auth:sanctum'])
                ->prefix('api/v1')
                ->group(base_path('routes/api/v1/private_api.php'));

            Route::middleware('api')
                ->prefix('api/v1')
                ->group(base_path('routes/api/v1/public_api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'auth.lock', 'auth:sanctum', 'checkRoleMiddleware', 'checkPinMiddleware'])
                ->prefix('admin')
                ->as('admin.')->group(base_path('routes/admin.php'));

            Route::middleware(['web', 'auth.lock', 'auth:sanctum', 'checkRoleMiddleware', 'checkPinMiddleware'])
                ->prefix('admin/global')
                ->as('admin.global.')->group(base_path('routes/global.php'));

            Route::middleware(['web', 'auth.lock', 'auth:sanctum', 'checkRoleMiddleware'])
                ->prefix('file_manager')
                ->as('file_manager.')->group(base_path('routes/file_manager.php'));

            Route::middleware(['web', 'auth:mobile-user', 'password.check'])
                ->prefix('mobileUser/admin')
                ->as('mobileUser.admin.')
                ->group(base_path('routes/mobileUser/admin.php'));

            Route::prefix('installer')
                ->as('installer.')
                ->middleware(['web', 'installerMiddleware'])
                ->namespace($this->namespace)
                ->group(base_path('routes/installer.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
