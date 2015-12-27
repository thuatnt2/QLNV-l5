<?php

use Illuminate\Database\Seeder;
use App\Unit;
// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class UnitsTableSeeder extends Seeder {

    public function run() {
        $units = [
            [
                "symbol" => "PA88",
                "description"   => "An ninh chính trị tư tưởng",
                "block"  => "AN",
            ],
            [
                "symbol" => "PA92",
                "description"   => "xxxxxxxxx",
                "block"  => "AN",
            ],
            [
                "symbol" => "PC45",
                "description"   => "Phòng chống mà túy",
                "block"  => "CS",
            ]
        ];
        foreach ($units as $unit) {

            Unit::create($unit);
        }
    }

}
