<?php

namespace App\Http\Controllers;

use App\Http\Requests\TokenStoreRequest;
use App\Services\TokenService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class TokenController extends Controller
{
    public function __construct(
        protected TokenService $tokenService,
    ) {}

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $show   = $request->input('show', 10);

        $tokens = $this->tokenService->readFilter($search, $show);

        $data = [
            'tokens' => $tokens,
        ];

        return view('tokens.index', compact('data'));
    }

    public function store(TokenStoreRequest $request)
    {
        try {
            $this->tokenService->createData($request->validated());

            return redirect()->back()->with('success', 'Successfully saved data');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while saving data');
        }
    }

    public function show($id)
    {
        try {
            $id    = Crypt::decryptString($id);
            $token = $this->tokenService->readId($id);

            $data = [
                'token' => $token,
            ];

            return view('tokens.show', compact('data'));
        } catch (\Throwable $e) {
            if ($e instanceof DecryptException || $e instanceof \RuntimeException) {
                Log::error('MANAGE TOKEN-SHOW: ', ['exception' => $e]);
                return redirect()->back()->with('error', 'Sorry, the ID you entered is invalid');
            }

            Log::error('MANAGE TOKEN-SHOW: ', ['exception' => $e]);
            return redirect()->back()->with('error', 'An error occurred while retrieving data');
        }
    }
}
