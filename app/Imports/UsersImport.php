<?php

namespace App\Imports;

use App\Models\Collector;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = User::factory()->create([
                'name'     => Str::title($row['nama']),
                'username' => Str::lower($row['username']),
                'email'    => Str::lower($row['email']),
                'phone'    => $row['telepon'],
                'office'   => $row['kantor'],
                'password' => Hash::make('12345'),
            ]);

            $user->assignRole($row['jabatan']);
            Collector::create(['user_id' => $user->id]);
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
