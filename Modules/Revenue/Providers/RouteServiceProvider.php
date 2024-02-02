<?php

namespace Modules\Revenue\Providers;

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
            ->prefix('revenue')
            ->as('revenue.')
            ->group(module_path('Revenue', '/Routes/web.php'));

        Route::middleware(['web', 'auth.lock', 'auth:sanctum', 'checkRoleMiddleware', 'checkPinMiddleware'])
            ->prefix('admin/revenue')
            ->as('admin.revenue.')
            ->group(module_path('Revenue', '/Routes/admin.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(module_path('Revenue', '/Routes/api.php'));
    }
}
