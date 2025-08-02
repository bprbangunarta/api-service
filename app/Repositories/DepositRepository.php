<?php

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Support\Carbon;

class DepositRepository
{
    public function read_all()
    {
        return Transaction::where('type', 'deposit')->orderBy('name')->get();
    }

    public function read_filter($collector_code, $search)
    {
        $deposits = Transaction::where('type', 'deposit')->where('collector_code', $collector_code);

        if ($search) {
            $deposits->where(function ($query) use ($search) {
                $query->where('number', 'like', "%$search%")
                    ->orWhere('account', 'like', "%$search%");
            });
        }

        return $deposits->orderBy('created_at', 'DESC')->get();
    }

    public function read_today($collector_code, $search)
    {
        $deposits = Transaction::where('type', 'deposit')->where('collector_code', $collector_code);

        if ($search) {
            $deposits->where(function ($query) use ($search) {
                $query->where('number', 'like', "%$search%")
                    ->orWhere('account', 'like', "%$search%");
            });
        }

        return $deposits->whereDate('created_at', Carbon::today())->orderBy('created_at', 'DESC')->get();
    }

    public function read_deposit($number)
    {
        return Transaction::where('type', 'deposit')->where('number', $number)->first();
    }

    public function create_deposit($data)
    {
        return Transaction::create($data);
    }
}
