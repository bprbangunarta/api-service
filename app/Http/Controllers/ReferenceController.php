<?php

namespace App\Http\Controllers;

use App\Services\CoaService;
use App\Services\OfficeService;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class ReferenceController extends Controller
{
    public function __construct(
        protected OfficeService $officeService,
        protected CoaService $coaService,
    ) {}

    public function office_index(Request $request)
    {
        $search = $request->input('search', '');
        $show   = $request->input('show', 10);

        $offices = $this->officeService->readFilter($search, $show);

        $data = [
            'offices' => $offices,
        ];

        return view('references.offices.index', compact('data'));
    }

    public function office_create()
    {
        return view('references.offices..create');
    }

    public function office_show($id)
    {
        try {
            $id     = Crypt::decryptString($id);
            $office = $this->officeService->readId($id);

            $data = [
                'office' => $office,
            ];

            return view('references.offices.show', compact('data'));
        } catch (\Throwable $e) {
            if ($e instanceof DecryptException || $e instanceof \RuntimeException) {
                Log::error('MANAGE OFFICE-SHOW: ', ['exception' => $e]);
                return redirect()->back()->with('error', 'Sorry, the ID you entered is invalid');
            }

            Log::error('MANAGE OFFICE-SHOW: ', ['exception' => $e]);
            return redirect()->back()->with('error', 'An error occurred while retrieving data');
        }
    }

    public function account_index(Request $request)
    {
        $search = $request->input('search', '');
        $show   = $request->input('show', 10);

        $accounts = $this->coaService->readFilter($search, $show);

        $data = [
            'accounts' => $accounts,
        ];

        return view('references.accounts.index', compact('data'));
    }

    public function account_create()
    {
        return view('references.accounts..create');
    }

    public function account_show($id)
    {
        try {
            $id      = Crypt::decryptString($id);
            $account = $this->coaService->readId($id);

            $data = [
                'account' => $account,
            ];

            return view('references.accounts.show', compact('data'));
        } catch (\Throwable $e) {
            if ($e instanceof DecryptException || $e instanceof \RuntimeException) {
                Log::error('MANAGE COA-SHOW: ', ['exception' => $e]);
                return redirect()->back()->with('error', 'Sorry, the ID you entered is invalid');
            }

            Log::error('MANAGE COA-SHOW: ', ['exception' => $e]);
            return redirect()->back()->with('error', 'An error occurred while retrieving data');
        }
    }
}
