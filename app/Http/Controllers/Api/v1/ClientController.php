<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function show(Request $request)
    {
        return response()->json([
            'status'  => true,
            'message' => 'Welcome',
            'data'    => Auth::guard('api')->user(),
        ], 200);
    }
}
