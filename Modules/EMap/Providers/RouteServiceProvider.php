<?php

namespace Modules\EMap\Providers;

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
        Route::middleware('web')
            ->group(module_path('EMap', '/Routes/web.php'));


        Route::middleware(['web', 'auth:organization', 'password.check'])
            ->prefix('organization/admin')
            ->as('organization.admin.')
            ->group(base_path('/Modules/EMap/Routes/organization/admin.php'));

        Route::middleware(['web', 'auth.lock', 'auth:sanctum', 'checkRoleMiddleware', 'checkPinMiddleware'])
            ->prefix('admin/emap')
            ->as('emap.admin.')
            ->group(module_path('EMap', '/Routes/admin.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(module_path('EMap', '/Routes/api.php'));
        Route::middleware('api')
            ->prefix('ebps/api/v1')
            ->group(module_path('EMap', '/Routes/api/publicRoute.php'));
        Route::middleware(['api', 'auth:sanctum'])
            ->prefix('ebps/api/v1/user')
            ->group(module_path('EMap', '/Routes/api/privateRoute.php'));
    }
}
