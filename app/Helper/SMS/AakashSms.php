<?php

namespace App\Helper\SMS;

use App\Interfaces\SmsInterface;
use App\Models\Sms;

class AakashSms implements SmsInterface
{
    public function sendTextSMS($contact, $message = "Hello Text"): Sms
    {
        $args = http_build_query(array(
            'auth_token' => config('sms.aakash.api_key'),
            'to' => $contact,
            'text' => $message
        ));

        $url = "https://sms.aakashsms.com/sms/v3/send/";

        $response = $this->makeTheCallUsingAPI($url, $args);

        return self::storeSmsDetail($contact, $message, $response);
    }

    public function getCreditBalance($type = ''): int
    {
        $args = http_build_query(array(
            'auth_token' => config('sms.aakash.api_key')
        ));

        $url = "https://sms.aakashsms.com/sms/v1/credit";

        $response = json_decode($this->makeTheCallUsingAPI($url, $args));

        return match ($type) {
            'sms_sent' => $response->total_sms_sent ?? 0,
            default => $response->available_credit ?? 0,
        };
    }

    public function getReport($page = 1)
    {
        $args = http_build_query(array(
            'auth_token' => config('sms.aakash.api_key'),
            'page' => $page
        ));

        $url = "https://sms.aakashsms.com/sms/v1/report/api";

        return json_decode($this->makeTheCallUsingAPI($url, $args));
    }

    /**
     * @param $contact
     * @param mixed $message
     * @param bool|string $response
     * @return Sms
     */
    public function storeSmsDetail($contact, mixed $message, bool|string $response): Sms
    {
        return Sms::create([
            'api_used' => 'Aakash SMS',
            'phone' => $contact,
            'message' => $message,
            'response_data' => $response,
        ]);
    }

    /**
     * @param string $url
     * @param string $args
     * @return bool|string
     */
    public function makeTheCallUsingAPI(string $url, string $args): string|bool
    {
        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1); ///
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Response
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
