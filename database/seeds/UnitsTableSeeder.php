<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class UnitsTableSeeder extends Seeder {

    public function run() {
        $units = [
            [
                "symbol" => "PA88",
                "name"   => "An ninh chính trị tư tưởng",
                "block"  => "AN",
            ],
            [
                "symbol" => "PA92",
                "name"   => "xxxxxxxxx",
                "block"  => "AN",
            ],
            [
                "symbol" => "PC45",
                "name"   => "Phòng chống mà túy",
                "block"  => "CS",
            ]
        ];
        foreach ($units as $unit) {

            Unit::create($unit);
        }
    }

}
