<?php

use App\Network;
use Illuminate\Database\Seeder;

class NetworkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $networks = [
	        [
	        	'name' => 'viettel'
	        ],
       	    [
	        	'name' => 'vinaphone'
	        ],
		    [
	        	'name' => 'mobifone'
	        ]

        ];

        foreach ($networks as $network) {
        	Network::create($network);
        }
    }
}
