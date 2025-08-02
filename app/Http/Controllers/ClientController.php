<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Services\ClientLogService;
use App\Services\ClientService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    public function __construct(
        protected ClientService $clientService,
        protected ClientLogService $clientlogService,
    ) {}

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $show   = $request->input('show', 10);

        $clients = $this->clientService->readFilter($search, $show);

        $data = [
            'clients' => $clients,
        ];

        return view('clients.index', compact('data'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(ClientStoreRequest $request)
    {
        try {
            $this->clientService->createData($request->validated());

            return redirect()->back()->with('success', 'Successfully saved data');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while saving data');
        }
    }

    public function show($id, Request $request)
    {
        $search = $request->input('search', '');
        $show   = $request->input('show', 10);

        try {
            $id        = Crypt::decryptString($id);
            $client    = $this->clientService->readId($id);
            $clientLog = $this->clientlogService->readFilterClient($client->client_id, $search, $show);

            $data = [
                'client' => $client,
                'logs'   => $clientLog,
            ];

            return view('clients.show', compact('data'));
        } catch (\Throwable $e) {
            if ($e instanceof DecryptException || $e instanceof \RuntimeException) {
                Log::error('MANAGE CLIENT-SHOW: ', ['exception' => $e]);
                return redirect()->back()->with('error', 'Sorry, the ID you entered is invalid');
            }

            Log::error('MANAGE CLIENT-SHOW: ', ['exception' => $e]);
            return redirect()->back()->with('error', 'An error occurred while retrieving data');
        }
    }

    public function show_logs($id)
    {
        $apilog = $this->clientlogService->readId($id);

        return response()->json([
            'client_id'          => $apilog->client_id,
            'ip_address'         => $apilog->request_headers,
            'method'             => $apilog->method,
            'url'                => $apilog->url,
            'response_status'    => $apilog->response_status,
            'response_body'      => $apilog->response_body,
        ]);
    }

    public function update(string $id, ClientUpdateRequest $request)
    {
        try {
            $id = Crypt::decryptString($id);
            $this->clientService->updateData($id, $request->validated());

            return redirect()->back()->with('success', 'Successfully changed data');
        } catch (\Throwable $e) {
            if ($e instanceof DecryptException || $e instanceof \RuntimeException) {
                Log::error('MANAGE CLIENT-UPDATE: ', ['exception' => $e]);
                return redirect()->back()->with('error', 'Sorry, the ID you entered is invalid');
            }

            Log::error('MANAGE CLIENT-UPDATE: ', ['exception' => $e]);
            return redirect()->back()->with('error', 'An error occurred while changing data');
        }
    }

    public function destroy($id, Request $request)
    {
        $request->validate([
            'delete_client' => ['required', 'current_password'],
        ]);

        try {
            $id = Crypt::decryptString($id);
            $this->clientService->deleteData($id);

            return redirect()->route('client.index')->with('success', 'Successfully deleted data');
        } catch (DecryptException $e) {
            return redirect()->back()->with('error', 'Sorry, the ID you entered is invalid');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting data');
        }
    }

    public function restore($id, Request $request)
    {
        $request->validate([
            'restore_client' => ['required', 'current_password'],
        ]);

        try {
            $id = Crypt::decryptString($id);
            $this->clientService->restoreData($id);

            return redirect()->route('client.index')->with('success', 'Successfully recovered data');
        } catch (DecryptException $e) {
            return redirect()->back()->with('error', 'Sorry, the ID you entered is invalid');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while restoring data');
        }
    }
}
