<?php

namespace Modules\DigitalBoard\Providers;

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
            ->prefix('digitalboard')
            ->as('digitalBoard.')
            ->group(module_path('DigitalBoard', '/Routes/web.php'));

        Route::middleware(['web', 'auth.lock', 'auth:sanctum', 'checkRoleMiddleware','checkPinMiddleware'])
            ->prefix('admin/digitalBoard')
            ->as('admin.digitalBoard.')
            ->group(module_path('DigitalBoard', '/Routes/admin.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(module_path('DigitalBoard', '/Routes/api.php'));

        Route::prefix('api/v1/digitalboard')
            ->middleware('api')
            ->group(module_path('DigitalBoard', '/Routes/api/v1/public_api.php'));
    }
}
