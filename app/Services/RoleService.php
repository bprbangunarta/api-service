<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    public function __construct(
        protected RoleRepository $roleRepo,
    ) {}

    public function readAll()
    {
        return $this->roleRepo->read_all();
    }
}
