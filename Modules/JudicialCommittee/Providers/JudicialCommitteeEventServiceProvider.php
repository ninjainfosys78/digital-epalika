<?php

namespace Modules\JudicialCommittee\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\JudicialCommittee\Events\ComplaintLogEvent;
use Modules\JudicialCommittee\Listeners\ComplaintLogListener;

class JudicialCommitteeEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ComplaintLogEvent::class => [
            ComplaintLogListener::class
        ]
    ];
}
