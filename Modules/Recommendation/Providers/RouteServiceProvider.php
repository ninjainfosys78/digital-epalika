<?php

namespace Modules\Recommendation\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->prefix('recommendation')
            ->as('recommendation')
            ->group(module_path('Recommendation', '/Routes/web.php'));

        Route::middleware(['web', 'auth.lock', 'auth:sanctum', 'checkRoleMiddleware', 'checkPinMiddleware'])
            ->prefix('admin/recommendation')
            ->as('admin.recommendation.')
            ->group(module_path('Recommendation', '/Routes/admin.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(module_path('Recommendation', '/Routes/api.php'));
        Route::prefix('api/v1/recommendation')
            ->middleware('api')
            ->group(module_path('Recommendation', '/Routes/api/publicRoute.php'));
        Route::prefix('api/v1/recommendation/user')
            ->middleware(['api', 'auth:sanctum'])
            ->group(module_path('Recommendation', '/Routes/api/privateRoute.php'));
    }
}
