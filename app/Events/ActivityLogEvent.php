<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActivityLogEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $model;

    public $model_id;

    public $activity_type;

    public function __construct($activity_type, $model = null, $model_id = null)
    {
        $this->model = $model;
        $this->model_id = $model_id;
        $this->activity_type = $activity_type;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('channel-name');
    }
}
