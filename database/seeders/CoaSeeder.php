<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class CoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coa = [
            [
                'code'        => '01.61.005',
                'name'        => 'VA BRI',
                'office_code' => '00',
            ],
            [
                'code'        => '01.61.007',
                'name'        => 'VA MANDIRI',
                'office_code' => '00',
            ],
            [
                'code'        => '01.61.010',
                'name'        => 'VA PERMATA',
                'office_code' => '00',
            ],
            [
                'code'        => '1.100.2.1',
                'name'        => 'Kas Teller 1',
                'office_code' => '00',
            ],
            [
                'code'        => '1.100.2.2',
                'name'        => 'Kas Teller 2',
                'office_code' => '00',
            ],
            [
                'code'        => '1.100.2.3',
                'name'        => 'Kas Teller 3',
                'office_code' => '00',
            ],
            [
                'code'        => '1.100.4.01',
                'name'        => 'Kas Jalancagak',
                'office_code' => '01',
            ],
            [
                'code'        => '1.100.4.02',
                'name'        => 'Kas Subang',
                'office_code' => '02',
            ],
            [
                'code'        => '1.100.4.03',
                'name'        => 'Kas Sukamandi',
                'office_code' => '03',
            ],
            [
                'code'        => '1.100.4.04',
                'name'        => 'Kas Pageden',
                'office_code' => '04',
            ],
            [
                'code'        => '1.100.4.05',
                'name'        => 'Kas Kalijati',
                'office_code' => '05',
            ],
            [
                'code'        => '1.100.4.06',
                'name'        => 'Kas Pusaka Jaya',
                'office_code' => '06',
            ],
        ];

        foreach ($coa as $item) {
            \App\Models\Coa::create([
                'code'        => $item['code'],
                'name'        => Str::upper($item['name']),
                'office_code' => $item['office_code'],
            ]);
        }
    }
}
