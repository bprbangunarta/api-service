<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Http\Resources\DepositDetailResource;
use App\Http\Resources\DepositResource;
use App\Services\ClientLogService;
use App\Services\CollectorService;
use App\Services\DepositService;
use App\Services\SavingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepositController extends Controller
{
    public function __construct(
        protected CollectorService $collectorService,
        protected DepositService $depositService,
        protected SavingService $savingService,
        protected ClientLogService $clientlogService,
    ) {}

    public function index($collector, Request $request)
    {
        try {
            $search   = $request->input('search', '');
            $deposits = $this->depositService->readToday($collector, $search);
            if (!$deposits) {
                $response = response()->json([
                    'status'  => false,
                    'message' => 'Make sure the collector code is correct',
                ], 401);

                $this->clientlogService->createData($request, $response);
                return $response;
            }

            $response = response()->json([
                'status'  => true,
                'message' => 'Transactions list',
                'data'    => DepositResource::collection($deposits)
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

    public function store(DepositRequest $request)
    {
        try {
            $number = $this->depositService->generateNumber($request->input('collector_code'));

            $data = [
                'number'           => $number,
                'office'           => $request->input('office'),
                'collector_code'   => $request->input('collector_code'),
                'type'             => 'deposit',
                'account'          => $request->input('account'),
                'source'           => $request->input('source'),
                'amount'           => $request->input('amount'),
                'previous_balance' => $request->input('previous_balance'),
                'ending_balance'   => $request->input('ending_balance'),
                'description'      => $request->input('description'),
            ];
            $this->depositService->createDeposit($data);

            $response = response()->json([
                'status'  => true,
                'message' => 'Transactions success',
                'data'    => $data
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

    public function show($number, Request $request)
    {
        try {
            $deposit = $this->depositService->readDeposit($number);
            if (!$deposit) {
                $response = response()->json([
                    'status'  => false,
                    'message' => 'Make sure the number is correct',
                ], 401);

                $this->clientlogService->createData($request, $response);
                return $response;
            }

            $saving = $this->savingService->readAccountDetail($deposit->account);
            if (!$saving) {
                $response = response()->json([
                    'status'  => false,
                    'message' => 'Make sure the account is correct',
                ], 401);

                $this->clientlogService->createData($request, $response);
                return $response;
            }

            $collector = $this->collectorService->findFunding($deposit->collector_code);
            if (!$collector) {
                $response = response()->json([
                    'status'  => false,
                    'message' => 'Make sure the collector is correct',
                ], 401);

                $this->clientlogService->createData($request, $response);
                return $response;
            }

            $response = response()->json([
                'status'  => true,
                'message' => 'Transactions details',
                'data'    => new DepositDetailResource($deposit, $saving, $collector)
            ], 200);

            $this->clientlogService->createData($request, $response);
            return $response;
        } catch (\Throwable $e) {
            Log::error('Deposit Details: ' . $e->getMessage());

            $response = response()->json([
                'status'  => false,
                'message' => 'Internal Server Error wkwk'
            ], 500);

            $this->clientlogService->createData($request, $response);
            return $response;
        }
    }
}
