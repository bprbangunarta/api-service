<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectorUpdateRequest;
use App\Services\CollectorService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class CollectorController extends Controller
{
    public function __construct(
        protected CollectorService $collectorService
    ) {}

    public function update(string $id, CollectorUpdateRequest $request)
    {
        try {
            $id = Crypt::decryptString($id);
            $this->collectorService->updateData($id, $request->validated());

            return redirect()->back()->with('success', 'Successfully changed data');
        } catch (\Throwable $e) {
            if ($e instanceof DecryptException || $e instanceof \RuntimeException) {
                Log::error('MANAGE COLLECTOR-UPDATE: ', ['exception' => $e]);
                return redirect()->back()->with('error', 'Sorry, the ID you entered is invalid');
            }

            Log::error('MANAGE COLLECTOR-UPDATE: ', ['exception' => $e]);
            return redirect()->back()->with('error', 'An error occurred while changing data');
        }
    }
}
