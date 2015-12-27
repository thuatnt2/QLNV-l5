<?php

use Illuminate\Database\Seeder;
use App\Kind;
// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class KindsTableSeeder extends Seeder {

    public function run() {
        $kinds = [
            [
                "symbol"      => "HS",
                "description" => "Hình sự",
            ],
            [
                "symbol"      => "MT",
                "description" => "Ma túy",
            ],
            [
                "symbol"      => "PĐ",
                "description" => "Phản động",
            ]
        ];
        foreach ($kinds as $kind) {

            Kind::create($kind);
        }
    }

}
