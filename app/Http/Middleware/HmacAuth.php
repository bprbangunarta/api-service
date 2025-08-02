<?php

namespace App\Http\Middleware;

use App\Services\ClientLogService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class HmacAuth
{
    public function __construct(
        protected ClientLogService $clientlogService,
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // request
        if (!$request->header('X-CLIENT-ID') || !$request->header('X-SIGNATURE') || !$request->header('X-TIMESTAMP')) {
            $response = response()->json([
                'status'  => false,
                'message' => 'Make sure the X-CLIENT-ID, X-SIGNATURE and X-TIMESTAMP is filled in',
            ], 401);

            $this->clientlogService->createData($request, $response);
            return $response;
        }

        // client
        $client = \App\Models\Client::where('client_id', $request->header('X-CLIENT-ID'))->first();
        if (!$client) {
            $response =  response()->json([
                'status'  => false,
                'message' => 'Missing credentials',
            ], 401);

            $this->clientlogService->createData($request, $response);
            return $response;
        }

        try {
            $signatureHeader = $request->header('X-SIGNATURE');
            $cacheKey = "used_signature:$signatureHeader";

            // if (Cache::has($cacheKey)) {
            //     $response = response()->json([
            //         'status'  => false,
            //         'message' => 'Duplicate request',
            //     ], 401);

            //     $this->clientlogService->createData($request, $response);
            //     return $response;
            // }

            $signature = hash_hmac('sha256', $client->client_id . "|" . $client->client_key, $request->header('X-TIMESTAMP'));

            if (!hash_equals($signature, $signatureHeader)) {
                $response = response()->json([
                    'status'   => false,
                    'message'  => 'Invalid signature',
                    'received' => $signatureHeader,
                    'expected' => $signature
                ], 401);

                $this->clientlogService->createData($request, $response);
                return $response;
            }

            Cache::put($cacheKey, true, now()->addMinutes(5));
            Auth::guard('api')->setUser($client);

            return $next($request);
        } catch (\Throwable $e) {
            $response = response()->json([
                'status'  => false,
                'message' => 'Internal Server Error'
            ], 500);

            $this->clientlogService->createData($request, $response);
            return $response;
        }
    }
}
