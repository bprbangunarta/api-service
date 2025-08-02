<?php

namespace App\Repositories;

use App\Models\Saving;

class SavingRepository
{
    public function read_all()
    {
        return Saving::orderBy('name')->get();
    }

    public function read_filter($collector_code, $search)
    {
        $sevings = Saving::where('collector_code', $collector_code);

        if ($search) {
            $sevings->where(function ($query) use ($search) {
                $query->where('account', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            });
        }

        return $sevings->orderBy('name')->get();
    }

    public function read_address($account)
    {
        return Saving::where('account', $account)->value('address');
    }

    public function read_account($account)
    {
        return Saving::where('account', $account)->first();
    }
}
