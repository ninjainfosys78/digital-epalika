<?php

namespace Modules\JudicialCommittee\Events;

use Illuminate\Queue\SerializesModels;

class ComplaintLogEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public $complaint_application_id, public $model_type, public $model_id, public $title, public $description)
    {
        //
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
