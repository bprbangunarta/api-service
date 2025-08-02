<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OpenTransaction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $status = true;

            if ($status !== true) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Please try again during operating hours'
                ], 403);
            }

            return $next($request);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Internal Server Error'
            ], 500);
        }
    }
}
