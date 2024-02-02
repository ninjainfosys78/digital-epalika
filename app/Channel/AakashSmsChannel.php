<?php

namespace App\Channel;

use Illuminate\Notifications\Notification;

class AakashSmsChannel
{
    public function send($notifiable, Notification $notification): void
    {
        $message = $notification->toAakashSms($notifiable);

        $message->send();
    }
}
