<?php

namespace App\Repositories;

use App\Models\Office;

class OfficeRepository
{
    public function read_all()
    {
        return Office::orderBy('name')->get();
    }

    public function read_filter($search = '', $show = 10)
    {
        $client = Office::query();

        if ($search) {
            $client->where(function ($query) use ($search) {
                $query->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%$search%");
            });
        }

        return $client->orderBy('name')->paginate($show);
    }

    public function read_id($id)
    {
        return Office::findOrFail($id);
    }
}
