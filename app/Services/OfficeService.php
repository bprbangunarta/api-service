<?php

namespace App\Services;

use App\Repositories\OfficeRepository;
use Illuminate\Support\Facades\Request;

class OfficeService
{
    public function __construct(
        protected OfficeRepository $officeRepo,
    ) {}

    public function readAll()
    {
        return $this->officeRepo->read_all();
    }

    public function readFilter($search = '', $show = 10)
    {
        return $this->officeRepo->read_filter($search, $show);
    }

    public function readId(string $id)
    {
        try {
            return $this->officeRepo->read_id($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
