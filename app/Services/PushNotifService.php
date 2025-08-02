<?php

namespace App\Services;

use GuzzleHttp\Client;

class PushNotifService
{
    public function sendNotification($message)
    {
        $oneSignalAppId  = "e96be795-f0bf-4b7a-919b-2b10fb4ad62f";
        $oneSignalRestApiKey = "os_v2_app_5fv6pfpqx5fxvem3fmipwswwf7cqi6cqoyne2qe2q2qb4alt5o7t2qznuk4h2zdo6pwv3htcrbnkcv3loorynwd64m6iqyxouewwvra";

        $uniqueId = rand(1000, 9999);
        $title = "Transaksi Berhasil";

        $payload = [
            'app_id' => $oneSignalAppId,
            'included_segments' => ['All'],
            'data' => [
                'foo'       => 'bar',
                'link'      => null,
                'post_id'   => null,
                'unique_id' => $uniqueId
            ],
            'headings'    => ['en' => $title],
            'contents'    => ['en' => $message],
            'big_picture' => null,
            'url'         => null
        ];

        $client = new Client();

        try {
            $response = $client->post('https://api.onesignal.com/notifications', [
                'headers' => [
                    'Content-Type'  => 'application/json; charset=utf-8',
                    'Authorization' => 'Basic ' . $oneSignalRestApiKey
                ],
                'json' => $payload
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            \Log::error('OneSignal Notification Failed: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }
}
