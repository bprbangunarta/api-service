<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create users
        $collectors = [
            [
                "user_id"   => 1,
                "person"    => "BPR",
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => null,
                "credit"    => null,
            ],
            [
                "user_id"   => 2,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "629",
                "credit"    => null,
            ],
            [
                "user_id"   => 3,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "612",
                "credit"    => null,
            ],
            [
                "user_id"   => 4,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "618",
                "credit"    => null,
            ],
            [
                "user_id"   => 5,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "575",
                "credit"    => null,
            ],
            [
                "user_id"   => 6,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "557",
                "credit"    => null,
            ],
            [
                "user_id"   => 7,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "638",
                "credit"    => null,
            ],
            [
                "user_id"   => 8,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "571",
                "credit"    => null,
            ],
            [
                "user_id"   => 9,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "572",
                "credit"    => null,
            ],
            [
                "user_id"   => 10,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "608",
                "credit"    => null,
            ],
            [
                "user_id"   => 11,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "567",
                "credit"    => null,
            ],
            [
                "user_id"   => 12,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "592",
                "credit"    => null,
            ],
            [
                "user_id"   => 13,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "580",
                "credit"    => null,
            ],
            [
                "user_id"   => 14,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "560",
                "credit"    => null,
            ],
            [
                "user_id"   => 15,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "610",
                "credit"    => null,
            ],
            [
                "user_id"   => 16,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "569",
                "credit"    => null,
            ],
            [
                "user_id"   => 17,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "644",
                "credit"    => null,
            ],
            [
                "user_id"   => 18,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "596",
                "credit"    => null,
            ],
            [
                "user_id"   => 19,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "642",
                "credit"    => null,
            ],
            [
                "user_id"   => 20,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "637",
                "credit"    => null,
            ],
            [
                "user_id"   => 21,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "639",
                "credit"    => null,
            ],
            [
                "user_id"   => 22,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "595",
                "credit"    => null,
            ],
            [
                "user_id"   => 23,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "568",
                "credit"    => null,
            ],
            [
                "user_id"   => 24,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "573",
                "credit"    => null,
            ],
            [
                "user_id"   => 25,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "579",
                "credit"    => null,
            ],
            [
                "user_id"   => 26,
                "person"    => null,
                "marketing" => null,
                "surveyor"  => null,
                "funding"   => "527",
                "credit"    => null,
            ]
        ];

        foreach ($collectors as $item) {
            $user = \App\Models\Collector::create([
                'user_id'   => $item['user_id'],
                'person'    => $item['person'],
                'marketing' => $item['marketing'],
                'surveyor'  => $item['surveyor'],
                'funding'   => $item['funding'],
                'credit'    => $item['credit'],
            ]);
        }
    }
}
