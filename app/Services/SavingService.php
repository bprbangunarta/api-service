<?php

namespace App\Services;

use App\Repositories\SavingRepository;
use Illuminate\Support\Facades\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class SavingService
{
    protected string $clientId;
    protected string $clientKey;
    protected string $endPoint;

    public function __construct(
        protected SavingRepository $savingRepo,
        protected TokenService $tokenService,
        protected Client $client,
    ) {
        $this->endPoint  = env('API_SERVER_URL');
        $this->clientId  = env('API_SERVER_ID');
        $this->clientKey = env('API_SERVER_KEY');
    }

    public function readAll()
    {
        return $this->savingRepo->read_all();
    }

    public function readFilter($collector_code, $search)
    {
        return $this->savingRepo->read_filter($collector_code, $search);
    }

    public function readAddress(string $account)
    {
        try {
            return $this->savingRepo->read_address($account);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function readAccountDetail(string $account)
    {
        try {
            return $this->savingRepo->read_account($account);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function readAccount(string $account)
    {
        $method    = "POST";
        $clientId  = env('API_SERVER_ID');
        $clientKey = env('API_SERVER_KEY');
        $urlPath   = "/api/v1/los/tabungan/info";
        $lastToken = $this->tokenService->lastToken();

        $contentBody = [
            'norek' => $account,
        ];
        $body = json_encode($contentBody, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $payload = "{$method}:{$urlPath}:{$clientId}:{$body}";
        $signature = hash_hmac('sha256', $payload, $clientKey);

        $client = new \GuzzleHttp\Client();

        $headers = [
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer ' . $lastToken,
            'X-Signature'   => $signature,
            'Content-Type'  => 'application/json'
        ];

        try {
            $response = $client->post('http://10.6.105.3:30000/api/v1/los/tabungan/info', [
                'headers' => $headers,
                'body'    => $body
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['code']) && $responseData['code'] === 'OK') {
                return $responseData['data'];
            }

            return null;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
