<?php

namespace Modules\GrievanceHandling\Providers;

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

    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->prefix('grievanceHandling')
            ->as('grievanceHandling.')
            ->group(module_path('GrievanceHandling', '/Routes/web.php'));

        Route::middleware('web')
            ->prefix('api/grievance')
            ->group(module_path('GrievanceHandling', '/Routes/api/publicRoute.php'));

        Route::middleware(['web', 'auth.lock', 'auth:sanctum', 'checkRoleMiddleware', 'checkPinMiddleware'])
            ->prefix('admin/grievanceHandling')
            ->as('admin.grievanceHandling.')
            ->group(module_path('GrievanceHandling', '/Routes/admin.php'));
    }

    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(module_path('GrievanceHandling', '/Routes/api.php'));
        Route::prefix('api/v1/grievance')
            ->middleware('api')
            ->group(module_path('GrievanceHandling', '/Routes/api/publicRoute.php'));
        Route::prefix('api/v1/grievance/user')
            ->middleware(['api', 'auth:sanctum'])
            ->group(module_path('GrievanceHandling', '/Routes/api/privateRoute.php'));
    }
}
