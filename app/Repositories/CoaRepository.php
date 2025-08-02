<?php

namespace App\Repositories;

use App\Models\Coa;

class CoaRepository
{
    public function read_all()
    {
        return Coa::orderBy('code')->get();
    }

    public function read_teller($office)
    {
        return Coa::where('office_code', $office)
            ->where('name', 'not like', '%VA%')
            ->orderBy('code')->get();
    }

    public function read_filter($search = '', $show = 10)
    {
        $client = Coa::query();

        if ($search) {
            $client->where(function ($query) use ($search) {
                $query->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%$search%");
            });
        }

        return $client->orderBy('code')->paginate($show);
    }

    public function read_id($id)
    {
        return Coa::findOrFail($id);
    }
}
