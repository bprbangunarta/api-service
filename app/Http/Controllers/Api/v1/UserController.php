<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoaResource;
use App\Http\Resources\UserResource;
use App\Services\ClientLogService;
use App\Services\CoaService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(
        protected CoaService $coaService,
        protected UserService $userService,
        protected ClientLogService $clientlogService,
    ) {}

    public function show(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        try {
            $username = $request->input('username');
            $password = $request->input('password');

            $user = $this->userService->findByUsername($username);

            if (!$user || !Hash::check($password, $user->password)) {
                $response = response()->json([
                    'status'  => false,
                    'message' => 'The credentials provided do not match!',
                ], 401);

                $this->clientlogService->createData($request, $response);
                return $response;
            }

            DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->delete();
            $coa = $this->coaService->readTeller($user->office);

            $response = response()->json([
                'status'  => true,
                'message' => 'User details',
                'data'    => [
                    'token' => $user->createToken('auth_token')->plainTextToken,
                    'user'  => new UserResource($user),
                    'coa'   => CoaResource::collection($coa)
                ],
            ]);

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
}
