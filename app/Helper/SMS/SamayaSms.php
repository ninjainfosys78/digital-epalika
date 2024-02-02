<?php

namespace App\Helper\SMS;

use App\Interfaces\SmsInterface;
use App\Models\Sms;

class SamayaSms implements SmsInterface
{
    private mixed $api_key;

    private mixed $from;

    public function __construct()
    {
        $this->api_key = config('sms.samaya.api_key');
        $this->from = config('sms.samaya.sms_id');
    }

    public function sendTextSMS($contact, $message = 'Hello Test'): Sms
    {
        $url = 'https://bulk.textnepal.com/smsapi/index.php';

        $args = http_build_query(array(
            'key' => $this->api_key,
            'campaign' => 'XXXXXX',
            'routeid' => 'XXXXXX',
            'type' => 'text',
            'responsetype' => 'json',
            'contacts' => $contact,
            'senderid' => $this->from,
            'msg' => $message
        ));


        //Submit to server

        $response = $this->submitToServer($url, $args);


        return self::storeSmsDetail($contact, $message, $response);
    }

    public function getCreditBalance($type = ''): int
    {
        $api_url = 'https://bulk.textnepal.com/miscapi/' . $this->api_key . '/getBalance/true/';

        //Submit to server

        $response = json_decode(file_get_contents($api_url));

        $firstData = collect($response)?->first();
        return match ($type) {
            'route_id' => $firstData->ROUTE_ID ?? $firstData['ROUTE_ID'] ?? '',
            default => $firstData->BALANCE ?? $firstData['BALANCE'] ?? '',
        };
    }

    public function fetchApiKey($login_id, $password): bool|string
    {
        $api_url = 'https://bulk.textnepal.com/getkey/' . $login_id . '/' . $password;

        //Submit to server

        return file_get_contents($api_url);
    }

    public function getLastTransactionReport(): bool|string
    {
        $api_url = 'https://bulk.textnepal.com/lasttran/index.php?key=' . $this->api_key;

        //Submit to server

        return file_get_contents($api_url);
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
            'api_used' => 'Samaya SMS',
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
    public function submitToServer(string $url, string $args = ''): string|bool
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
