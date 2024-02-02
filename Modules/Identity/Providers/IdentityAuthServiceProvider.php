<?php

namespace Modules\Identity\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Identity\Entities\DisabilityIdentityCard;
use Modules\Identity\Entities\SeniorCitizenDetail;
use Modules\Identity\Policies\DisabilityIdentityCardPolicy;
use Modules\Identity\Policies\SeniorCitizenDetailPolicy;

class IdentityAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        DisabilityIdentityCard::class => DisabilityIdentityCardPolicy::class,
        SeniorCitizenDetail::class => SeniorCitizenDetailPolicy::class
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
