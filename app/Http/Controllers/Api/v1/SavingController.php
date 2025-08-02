<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SavingDetailResource;
use App\Http\Resources\SavingResource;
use App\Services\ClientlogService;
use App\Services\SavingService;
use App\Services\TokenService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SavingController extends Controller
{
    public function __construct(
        protected TokenService $tokenService,
        protected SavingService $savingService,
        protected ClientLogService $clientlogService,
    ) {}

    public function index($collector, Request $request)
    {
        try {
            $search  = $request->input('search', '');
            $savings = $this->savingService->readFilter($collector, $search);
            if (!$savings) {
                $response = response()->json([
                    'status'  => false,
                    'message' => 'Make sure the collector code is correct',
                ], 401);

                $this->clientlogService->createData($request, $response);
                return $response;
            }

            $response = response()->json([
                'status'  => true,
                'message' => 'Savings account list',
                'data'    => SavingResource::collection($savings)
            ], 200);

            $this->clientlogService->createData($request, $response);

            return $response;
        } catch (\Throwable $e) {
            $response = response()->json([
                'status'  => false,
                'message' => 'Internal Server Error'
            ], 500);

            $this->clientlogService->createData($request, $response);
            return $response;
        }
    }

    public function show($account, Request $request)
    {
        try {
            $saving = $this->savingService->readAccount($account);
            if (!$saving) {
                $response = response()->json([
                    'status'  => false,
                    'message' => 'Make sure the account is correct',
                ], 401);

                $this->clientlogService->createData($request, $response);
                return $response;
            }

            $address = $this->savingService->readAddress($account);

            $response = response()->json([
                'status'  => true,
                'message' => 'Savings account details',
                'data'    => new SavingDetailResource((object)$saving, $address)
            ], 200);

            $this->clientlogService->createData($request, $response);
            return $response;
        } catch (\Throwable $e) {
            Log::error('Accounts Details: ' . $e->getMessage());

            $response = response()->json([
                'status'  => false,
                'message' => 'Account not found or server error occurred'
            ], 500);

            $this->clientlogService->createData($request, $response);
            return $response;
        }
    }
}
