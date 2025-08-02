<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create cient
        $client = \App\Models\Client::create([
            'client_id'   => '06a8ac78-a85c-4316-819e-54476646f221',
            'client_name' => 'SAMBA',
            'client_key'  => '80965d76cd678e87a474836b6d5d7f30a784862bd6822a5f8e9cb5ef7682bb50',
        ]);

        $client->assignRole('Internal');
        $client->givePermissionTo('Inquiry Client');
        $client->givePermissionTo('Read Account');
        $client->givePermissionTo('Read Transaction');
        $client->givePermissionTo('Create Transaction');
    }
}
