<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Purpose;

class PurposesTableSeeder extends Seeder {

    public function run() {
        $purposes = [
            [
                "symbol" => "list",
                "group"   => "list",
            ],
            [
                 "symbol" => "xmctb",
                 "group"   => "xmctb",
            ],
            [
                 "symbol" => "imeil",
                 "group"   => "emei",
            ],
            [
                 "symbol" => "giám sát",
                 "group"   => "monitor",
            ],
        ];
        foreach ($purposes as $purpose) {

            Purpose::create($purpose);
        }
    }

}
