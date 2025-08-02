<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // guard web
            ['name' => 'Manage Users', 'guard_name' => 'web'],
            ['name' => 'Manage Roles', 'guard_name' => 'web'],
            ['name' => 'Manage Permissions', 'guard_name' => 'web'],
            ['name' => 'Manage Clients', 'guard_name' => 'web'],

            // guard api
            ['name' => 'Inquiry Client', 'guard_name' => 'api'],
            ['name' => 'Read Account', 'guard_name' => 'api'],
            ['name' => 'Read Transaction', 'guard_name' => 'api'],
            ['name' => 'Create Transaction', 'guard_name' => 'api'],
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create($permission);
        }
    }
}
