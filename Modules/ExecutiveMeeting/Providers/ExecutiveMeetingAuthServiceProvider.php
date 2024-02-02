<?php

namespace Modules\ExecutiveMeeting\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\ExecutiveMeeting\Entities\MunicipalCommittee;
use Modules\ExecutiveMeeting\Entities\WardCommittee;
use Modules\ExecutiveMeeting\Policies\MunicipalCommitteePolicy;
use Modules\ExecutiveMeeting\Policies\WardCommitteePolicy;

class ExecutiveMeetingAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        WardCommittee::class => WardCommitteePolicy::class,
        MunicipalCommittee::class => MunicipalCommitteePolicy::class
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
