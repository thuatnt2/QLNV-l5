<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PurposesTableSeeder extends Seeder {

    public function run() {
        $purposes = [
            [
                "content" => "list",
                "group"   => "list",
            ],
            [
                 "content" => "email",
                 "group"   => "list",
            ],
            [
                 "content" => "xmctb",
                 "group"   => "list",
            ],
            [
                 "content" => "giám sát",
                 "group"   => "monitor",
            ],
        ];
        foreach ($purposes as $purpose) {

            Purpose::create($purpose);
        }
    }

}
