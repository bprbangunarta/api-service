<?php

namespace App\Services;

use App\Models\Transaction;
use App\Repositories\DepositRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class DepositService
{
    public function __construct(
        protected DepositRepository $depositRepo,
        protected PushNotifService $pushService,
    ) {}

    public function generateNumber($collector_code)
    {
        do {
            $number = 'SMB' . $collector_code . '-' . Str::upper(Str::random(6));
        } while (Transaction::where('number', $number)->exists());

        return $number;
    }

    public function readAll()
    {
        return $this->depositRepo->read_all();
    }

    public function readFilter($collector_code, $search)
    {
        return $this->depositRepo->read_filter($collector_code, $search);
    }

    public function readToday($collector_code, $search)
    {
        return $this->depositRepo->read_today($collector_code, $search);
    }

    public function readDeposit(string $number)
    {
        try {
            return $this->depositRepo->read_deposit($number);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function createDeposit($data)
    {
        return DB::transaction(function () use ($data) {
            $transaction = $this->depositRepo->create_deposit($data);

            // update balance
            // ...

            // send to external API
            // ...

            // Kirim notifikasi SETELAH transaksi sukses
            DB::afterCommit(function () use ($data) {
                $formattedAmount = 'Rp' . number_format($data['amount'], 0, ',', '.');
                $message = $data['description'] . " sebesar " . $formattedAmount;
                $this->pushService->sendNotification($message);
            });

            return $transaction;
        });
    }
}
