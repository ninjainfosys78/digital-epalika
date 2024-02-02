<?php

namespace Modules\JudicialCommittee\Listeners;

use Modules\JudicialCommittee\Entities\ComplaintLog;

class ComplaintLogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event): void
    {
        ComplaintLog::create([
            'complaint_application_id' => $event->complaint_application_id,
            'model_type' => $event->model_type ?? null,
            'model_id' => $event->model_id ?? null,
            'title' => $event->title,
            'description' => $event->description,
        ]);
    }
}
