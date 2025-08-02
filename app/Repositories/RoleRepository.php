<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function read_all()
    {
        return Role::orderBy('name')->get();
    }
}
