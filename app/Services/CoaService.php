<?php

namespace App\Services;

use App\Repositories\CoaRepository;
use Illuminate\Support\Facades\Request;

class CoaService
{
    public function __construct(
        protected CoaRepository $coaRepo,
    ) {}

    public function readAll()
    {
        return $this->coaRepo->read_all();
    }

    public function readTeller($office)
    {
        return $this->coaRepo->read_teller($office);
    }

    public function readFilter($search = '', $show = 10)
    {
        return $this->coaRepo->read_filter($search, $show);
    }

    public function readId(string $id)
    {
        try {
            return $this->coaRepo->read_id($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
