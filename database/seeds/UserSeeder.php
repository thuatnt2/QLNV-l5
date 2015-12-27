<?php

use Illuminate\Database\Seeder;
use App\User;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserSeeder
 *
 * @author TNT
 */
class UserSeeder  extends Seeder{
    public function run() {
        $users = [
            [
                "name" => "admin",
                "email" => "thuatnt2@gmail.com",
                "password" => Hash::make("123456"),
            ],
            [
                "name" => "thuatnt",
                "email" => "ntthuat08t2@itf.dut.edu",
                "password" => Hash::make("123456"),
            ]
        ];
        foreach ($users as $user) {
            
            User::create($user);
        }
    }
}
