<?php

namespace App\Services;

use App\Repositories\ClientLogRepository;
use Illuminate\Support\Facades\Request;

class ClientLogService
{
    public function __construct(
        protected ClientLogRepository $clientlogRepo,
    ) {}

    public function readFilterClient($client_id, $search, $show)
    {
        return $this->clientlogRepo->read_filter_client($client_id, $search, $show);
    }

    public function readId(string $id)
    {
        try {
            return $this->clientlogRepo->read_id($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function createData($request, $response)
    {
        $responseBody = json_decode($response->getContent(), true);
        $responseBody = [
            'status'  => $responseBody['status'],
            'message' => $responseBody['message']
        ];
        $responseBody = json_encode($responseBody);

        $data = [
            'client_id'          => $request->header('X-CLIENT-ID'),
            'ip_address'         => $request->ip(),
            'method'             => $request->method(),
            'url'                => $request->fullUrl(),
            'response_status'    => $response->getStatusCode(),
            'response_body'      => $responseBody,
        ];

        return $this->clientlogRepo->create_data($data);
    }
}
