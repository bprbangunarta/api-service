<?php

namespace App\Repositories;

use App\Models\Collector;

class CollectorRepository
{
    public function find_funding($collector_code)
    {
        return Collector::with('user')->where('funding', $collector_code)->first();
    }

    public function read_id($id)
    {
        return Collector::where('user_id', $id)->first();
    }

    public function update_data(Collector $collector, array $data): bool
    {
        return $collector->update($data);
    }
}
