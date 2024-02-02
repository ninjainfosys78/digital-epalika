<?php

namespace Modules\Identity\Providers;

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
            ->group(module_path('Identity', '/Routes/web.php'));

        Route::middleware(['web', 'auth.lock', 'auth:sanctum', 'checkRoleMiddleware','checkPinMiddleware'])
            ->prefix('admin/identity')
            ->as('identity.admin.')
            ->group(module_path('Identity', '/Routes/admin.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(module_path('Identity', '/Routes/api.php'));
    }
}
