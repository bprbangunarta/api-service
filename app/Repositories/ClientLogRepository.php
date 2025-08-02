<?php

namespace App\Repositories;

use App\Models\ClientLog;

class ClientLogRepository
{
    public function read_all()
    {
        return ClientLog::orderBy('created_at', 'DESC')->get();
    }

    public function read_filter_client($client_id, $search = '', $show = 10)
    {
        $apilogs = ClientLog::withTrashed()
            ->where('client_id', $client_id);

        if ($search) {
            $apilogs->where(function ($query) use ($search) {
                $query->where('method', 'like', "%$search%")
                    ->orWhere('url', 'like', "%$search%")
                    ->orWhere('response_status', 'like', "%$search%")
                    ->orWhere('created_at', 'like', "%$search%");
            });
        }

        $apilogs = $apilogs
            ->orderBy('created_at', 'DESC')
            ->paginate($show);

        $apilogs->getCollection()->transform(function ($log) {
            $status = (int) $log->response_status;

            $log->badge_class = match (true) {
                $status >= 200 && $status < 300 => 'bg-green text-green-fg',
                $status >= 300 && $status < 400 => 'bg-blue text-blue-fg',
                $status >= 400 && $status < 500 => 'bg-yellow text-yellow-fg',
                $status >= 500                  => 'bg-red text-red-fg',
                default                         => 'bg-secondary text-secondary-fg',
            };

            return $log;
        });

        return $apilogs;
    }

    public function read_id($id)
    {
        return ClientLog::withTrashed()->findOrFail($id);
    }

    public function create_data(array $data)
    {
        return ClientLog::create($data);
    }
}
