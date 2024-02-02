<?php

namespace App\Providers;

use App\Http\Middleware\PageRenderMiddleware;
use App\Models\FeatureActivation;
use App\Models\File;
use App\Models\OfficeHeader;
use App\Models\Settings\Units\Unit;
use App\Models\Website\MunicipalDetail;
use App\Observers\FeatureActivationObserver;
use App\Observers\FileObserver;
use App\Observers\MunicipalDetailObserver;
use App\Observers\OfficeHeaderObserver;
use App\Observers\UnitObserver;
use Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        Paginator::useBootstrapFive();
    }

    public function boot()
    {
        Model::preventLazyLoading(!$this->app->isProduction());

        $this->defineObservers();

        Blade::componentNamespace('App\\View\\Components\\Navigation', 'admin');

        $this->defineGate();

        JsonResource::withoutWrapping();

        $this->defineMacro();

        $this->app->singleton(PageRenderMiddleware::class);
    }

    /**
     * @return void
     */
    public function defineObservers(): void
    {
        OfficeHeader::observe(OfficeHeaderObserver::class);
        FeatureActivation::observe(FeatureActivationObserver::class);
        Unit::observe(UnitObserver::class);
        MunicipalDetail::observe(MunicipalDetailObserver::class);
        File::observe(FileObserver::class);
    }

    /**
     * @return void
     */
    public function defineGate(): void
    {
        Gate::define('uploadFiles', function () {
            return true;
        });
    }

    /**
     * @return void
     */
    public function defineMacro(): void
    {
        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        str_contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });
    }
}
