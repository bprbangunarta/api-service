<?php

namespace App\Services;

use App\Repositories\CollectorRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class CollectorService
{
    public function __construct(
        protected CollectorRepository $collectorRepo,
        protected UserLogService $userlogService
    ) {}

    public function findFunding($collector_code)
    {
        try {
            return $this->collectorRepo->find_funding($collector_code);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function updateData(string $id, array $request): void
    {
        DB::beginTransaction();

        try {
            $collector = $this->collectorRepo->read_id($id);

            $data = [
                'person'    => $request['person'] != null ? Str::upper($request['person']) : null,
                'marketing' => $request['marketing'] ?? null,
                'surveyor'  => $request['surveyor'] ?? null,
                'funding'   => $request['funding'] ?? null,
                'credit'    => $request['credit'] ?? null,
            ];

            $this->collectorRepo->update_data($collector, $data);

            $this->userlogService->createData('Update Data Collector');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
