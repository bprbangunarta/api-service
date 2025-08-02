<?php

namespace App\Services;

use App\Repositories\TokenRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TokenService
{
    public function __construct(
        protected TokenRepository $tokenRepo,
        protected UserLogService $userlogService
    ) {}

    public function readAll()
    {
        return $this->tokenRepo->read_all();
    }

    public function readFilter($search = '', $show = 10)
    {
        return $this->tokenRepo->read_filter($search, $show);
    }

    public function readId(string $id)
    {
        try {
            return $this->tokenRepo->read_id($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function createData(array $request): void
    {
        DB::beginTransaction();

        try {
            $client = new Client();

            $response = $client->post('http://10.6.105.3:30000/token', [
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'client_id'     => 'api_bangunarta',
                    'client_secret' => 'pinYapi_bangunartau0Ti',
                    'grant_type'    => 'client_credentials'
                ],
                'timeout' => 10
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody(), true);

            if ($statusCode !== 200 || isset($responseBody['code'])) {
                Log::error('Failed to get token', [
                    'status'   => $statusCode,
                    'response' => $responseBody
                ]);

                throw new \Exception('Failed to get token: ' . ($responseBody['error'] ?? 'Unknown error'));
            }

            $data = [
                'name'       => $request['name'],
                'token'      => $responseBody['access_token'],
                'type'       => $responseBody['token_type'],
                'expires_in' => $responseBody['expires_in'],
            ];

            $this->tokenRepo->create_data($data);
            $this->userlogService->createData('Create Token');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Exception occurred while creating token', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }

    public function lastToken()
    {
        return $this->tokenRepo->last_token();
    }
}
