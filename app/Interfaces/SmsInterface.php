<?php

namespace App\Interfaces;

interface SmsInterface
{
    public function sendTextSMS($contact, $message);

    public function getCreditBalance($type = ''): int;
}
