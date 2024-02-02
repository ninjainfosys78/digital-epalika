<?php

namespace Modules\Circular\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

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
        Route::middleware(['web', 'auth.lock', 'auth:sanctum', 'checkRoleMiddleware','checkPinMiddleware'])
            ->prefix('admin/circular')
            ->as('admin.circular.')
            ->group(module_path('Circular', '/Routes/admin.php'));

        Route::middleware('web')
            ->prefix('circular')
            ->as('circular.')
            ->group(module_path('Circular', '/Routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(module_path('Circular', '/Routes/api.php'));
    }
}
