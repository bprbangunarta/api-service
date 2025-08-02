<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            // web
            ['name' => 'Administrator', 'guard_name' => 'web'],
            ['name' => 'Komisaris Utama', 'guard_name' => 'web'],
            ['name' => 'Komisaris', 'guard_name' => 'web'],
            ['name' => 'Direktur Utama', 'guard_name' => 'web'],
            ['name' => 'Direktur Kepatuhan', 'guard_name' => 'web'],
            ['name' => 'Direktur Bisnis', 'guard_name' => 'web'],
            ['name' => 'Direktur Operasional', 'guard_name' => 'web'],
            ['name' => 'Kepala Kantor Kas', 'guard_name' => 'web'],
            ['name' => 'Kepala Seksi Customer Care', 'guard_name' => 'web'],
            ['name' => 'Kepala Bagian Kepatuhan', 'guard_name' => 'web'],
            ['name' => 'Kepala Bagian Kredit', 'guard_name' => 'web'],
            ['name' => 'Kepala Seksi Kredit', 'guard_name' => 'web'],
            ['name' => 'Kepala Seksi Remedial', 'guard_name' => 'web'],
            ['name' => 'Kepala Seksi Umum', 'guard_name' => 'web'],
            ['name' => 'AO Kredit', 'guard_name' => 'web'],
            ['name' => 'Kepala Seksi Dana', 'guard_name' => 'web'],
            ['name' => 'AO Dana', 'guard_name' => 'web'],
            ['name' => 'Customer Care', 'guard_name' => 'web'],
            ['name' => 'Staff Umum', 'guard_name' => 'web'],
            ['name' => 'Kepala Bagian Operasional', 'guard_name' => 'web'],
            ['name' => 'Kepala Bagian Analis', 'guard_name' => 'web'],
            ['name' => 'Kepala Seksi Pelaporan', 'guard_name' => 'web'],
            ['name' => 'Staff Legal', 'guard_name' => 'web'],
            ['name' => 'Kepala Seksi Analis', 'guard_name' => 'web'],
            ['name' => 'Kepala Bagian Audit Internal', 'guard_name' => 'web'],
            ['name' => 'Kepala Seksi SDM', 'guard_name' => 'web'],
            ['name' => 'Kepala Seksi Administrasi Kredit', 'guard_name' => 'web'],
            ['name' => 'Kepala Bagian Teknologi Informasi', 'guard_name' => 'web'],
            ['name' => 'Staff Sistem & Jaringan', 'guard_name' => 'web'],
            ['name' => 'Customer Service', 'guard_name' => 'web'],
            ['name' => 'Kepala Bagian SDM & Umum', 'guard_name' => 'web'],
            ['name' => 'Staff Remedial', 'guard_name' => 'web'],
            ['name' => 'Kepala Bagian Pendanaan', 'guard_name' => 'web'],
            ['name' => 'Akunting', 'guard_name' => 'web'],
            ['name' => 'Staff SDM', 'guard_name' => 'web'],
            ['name' => 'Staff Analis & Appraisal', 'guard_name' => 'web'],
            ['name' => 'Marketing Deposito', 'guard_name' => 'web'],
            ['name' => 'Staff Web Development', 'guard_name' => 'web'],
            ['name' => 'Staff Kepatuhan', 'guard_name' => 'web'],
            ['name' => 'Staff Audit Internal', 'guard_name' => 'web'],
            ['name' => 'Staff Administrasi Kredit', 'guard_name' => 'web'],
            ['name' => 'Teller', 'guard_name' => 'web'],
            ['name' => 'Kepala Seksi Frontliner', 'guard_name' => 'web'],
            ['name' => 'Staff Teknologi Informasi', 'guard_name' => 'web'],

            // api
            ['name' => 'Internal', 'guard_name' => 'api'],
            ['name' => 'External', 'guard_name' => 'api'],
        ];
        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::create($role);
        }
    }
}
