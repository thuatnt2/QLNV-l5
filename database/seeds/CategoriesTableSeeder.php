<?php

use Illuminate\Database\Seeder;
use App\Category;
// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder {

    public function run() {
        $categories = [
            [
                "symbol"      => "ANQG",
                "description" => "An ninh quốc gia",
            ],
            [
                "symbol"      => "HN",
                "description" => "Hiềm nghi",
            ],
            [
                "symbol"      => "ST",
                "description" => "Sưu tra",
            ]
        ];
        foreach ($categories as $category) {

            Category::create($category);
        }
    }

}
