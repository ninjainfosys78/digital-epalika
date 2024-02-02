<?php

namespace Modules\ExecutiveMeeting\Providers;

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
            ->group(module_path('ExecutiveMeeting', '/Routes/web.php'));

        Route::middleware(['web', 'auth.lock', 'auth:sanctum', 'checkRoleMiddleware','checkPinMiddleware'])
            ->prefix('admin/executivemeeting')
            ->as('admin.executiveMeeting.')
            ->group(module_path('ExecutiveMeeting', '/Routes/admin.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(module_path('ExecutiveMeeting', '/Routes/api.php'));
    }
}
