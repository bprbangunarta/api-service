<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create users
        $users = [
            [
                "name"     => "Administrator",
                "username" => "admin",
                "email"    => "sa@bprbangunarta.co.id",
                "password" => '1',
                "role"     => "Administrator",
                "office"   => "00",
            ],
            [
                "name"     => "AGIS",
                "username" => "agis",
                "email"    => "agis@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "AGUNG",
                "username" => "agung",
                "email"    => "agung@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "ALDI",
                "username" => "aldi",
                "email"    => "aldi@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "ALI",
                "username" => "ali",
                "email"    => "ali@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "ANGGI",
                "username" => "anggi",
                "email"    => "anggi@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "AVIT",
                "username" => "avit",
                "email"    => "avit@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "DEDE",
                "username" => "dede",
                "email"    => "dede@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "DELA",
                "username" => "dela",
                "email"    => "dela@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "DENIS",
                "username" => "denis",
                "email"    => "denis@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "DEVI",
                "username" => "devi",
                "email"    => "devi@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "DIAN",
                "username" => "dian",
                "email"    => "dian@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "DIKI",
                "username" => "diki",
                "email"    => "diki@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "DUDUNG",
                "username" => "dudung",
                "email"    => "dudung@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "FIRHAN",
                "username" => "firhan",
                "email"    => "firhan@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "HELDI",
                "username" => "heldi",
                "email"    => "heldi@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "JUNAEDI",
                "username" => "junaedi",
                "email"    => "junaedi@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "NANANG",
                "username" => "nanang",
                "email"    => "nanang@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "PAHLEVI",
                "username" => "pahlevi",
                "email"    => "pahlevi@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "RIO",
                "username" => "rio",
                "email"    => "rio@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "RULLY",
                "username" => "rully",
                "email"    => "rully@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "SYAHRUDIN",
                "username" => "syahrudin",
                "email"    => "syahrudin@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "TIA",
                "username" => "tia",
                "email"    => "tia@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "TOVA",
                "username" => "tova",
                "email"    => "tova@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "WISNU",
                "username" => "wisnu",
                "email"    => "wisnu@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ],
            [
                "name"     => "YONGKI",
                "username" => "yongki",
                "email"    => "yongki@bprbangunarta.co.id",
                "password" => '12345',
                "role"     => "AO Dana",
                "office"   => null,
            ]
        ];

        foreach ($users as $item) {
            $user = \App\Models\User::factory()->create([
                'name'     => Str::title($item['name']),
                'username' => Str::lower($item['username']),
                'email'    => Str::lower($item['email']),
                'office'   => $item['office'],
                'password' => Hash::make($item['password']),
            ]);

            $user->assignRole($item['role']);
        }
    }
}
