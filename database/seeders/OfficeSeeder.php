<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offices = [
            [
                'code'    => '00',
                'name'    => 'KANTOR PUSAT PAMANUKAN',
                'address' => 'Jl. H. Iksan No.89 Pamanukan'
            ],
            [
                'code'    => '01',
                'name'    => 'KANTOR KAS JALANCAGAK',
                'address' => 'Jl. Raya Jalancagak No.54, RT 10 RW002  Jalancagak'
            ],
            [
                'code'    => '02',
                'name'    => 'KANTOR KAS SUBANG',
                'address' => 'Jl. Oto Iskandardinata No.73 Subang'
            ],
            [
                'code'    => '03',
                'name'    => 'KANTOR KAS SUKAMANDI',
                'address' => 'Jl. Ahmad Yani No.7 Ciasem'
            ],
            [
                'code'    => '04',
                'name'    => 'KANTOR KAS PAGADEN',
                'address' => 'Jl. Kamarung Selatan RT 37 RW 10 Pagaden'
            ],
            [
                'code'    => '05',
                'name'    => 'KANTOR KAS KALIJATI',
                'address' => 'Kp Babakan Bandung RT 009 RW 03 Ds Kalijati Barat Kec Kalijati'
            ],
            [
                'code'    => '06',
                'name'    => 'KANTOR KAS PUSAKAJAYA',
                'address' => 'Jl. Raya Pantura Pusakanagara'
            ],
        ];

        foreach ($offices as $office) {
            \App\Models\Office::create([
                'code'    => $office['code'],
                'name'    => $office['name'],
                'address' => Str::upper($office['address']),
            ]);
        }
    }
}
