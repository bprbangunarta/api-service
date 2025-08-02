<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientService
{
    public function __construct(
        protected ClientRepository $clientRepo,
        protected UserLogService $userlogService
    ) {}

    public function readAll()
    {
        return $this->clientRepo->read_all();
    }

    public function readFilter($search = '', $show = 10)
    {
        return $this->clientRepo->read_filter($search, $show);
    }

    public function createData(array $request): void
    {
        DB::beginTransaction();

        try {
            $data = [
                'client_id'   => Str::uuid(),
                'client_name' => $request['client_name'],
                'client_key'  => bin2hex(random_bytes(32)),
            ];

            $this->clientRepo->create_data($data);

            $this->userlogService->createData('Create Data Client');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function readId(string $id)
    {
        try {
            return $this->clientRepo->read_id($id);
        } catch (DecryptException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function updateData(string $id, array $request): void
    {
        DB::beginTransaction();

        try {
            $client = $this->clientRepo->read_id($id);

            $data = [
                'client_name' => $request['client_name'],
            ];

            $this->clientRepo->update_data($client, $data);

            $this->userlogService->createData('Update Data Client');

            DB::commit();
        } catch (DecryptException $e) {
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteData(string $id): void
    {
        DB::beginTransaction();

        try {
            $client = $this->clientRepo->read_id($id);

            $this->clientRepo->delete_data($client);

            $this->userlogService->createData('Delete Data Client');

            DB::commit();
        } catch (DecryptException $e) {
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function restoreData(string $id): void
    {
        DB::beginTransaction();

        try {
            $client = $this->clientRepo->read_id($id);

            $this->clientRepo->restore_data($client);

            $this->userlogService->createData('Restore Data Client');

            DB::commit();
        } catch (DecryptException $e) {
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
