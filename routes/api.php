<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::middleware(['open.transaction', 'hmac.auth'])->group(function () {
        // use permission -> middleware('permission:Read User,api');
        Route::get('/client', [\App\Http\Controllers\Api\v1\ClientController::class, 'show']);
        Route::get('/user-funding', [\App\Http\Controllers\Api\v1\UserController::class, 'funding_show']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/savings/{collector}', [\App\Http\Controllers\Api\v1\SavingController::class, 'index']);
            Route::get('/saving/{account}', [\App\Http\Controllers\Api\v1\SavingController::class, 'show']);

            Route::get('/deposits/{collector}', [\App\Http\Controllers\Api\v1\DepositController::class, 'index']);
            Route::get('/deposit/{number}', [\App\Http\Controllers\Api\v1\DepositController::class, 'show']);
            Route::post('/deposit', [\App\Http\Controllers\Api\v1\DepositController::class, 'store']);
        });
    });
});
