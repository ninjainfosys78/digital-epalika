<?php

namespace App\Channel\Message;

use Exception;

class AakashSmsMessage
{
    protected string $message = '';

    protected string $receiver = '';

    public function receiver($receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function message($message = ''): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function send()
    {
        if (empty($this->receiver) || empty($this->message)) {
            throw new Exception('SMS not correct.');
        }

        $args = http_build_query(
            [
                'auth_token' => config('service.aakash.api'),
                'to' => $this->receiver,
                'text' => $this->message,
            ]
        );
        $url = 'https://sms.aakashsms.com/sms/v3/send/';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        curl_close($ch);

        \Log::debug($response);

        return json_decode($response, true);
    }
}
