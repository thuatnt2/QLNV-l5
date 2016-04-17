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
                "username" => "admin",
                "fullname" => "admin",
                "password" => Hash::make("admin"),
                "role" => "admin",
            ],
        ];
        foreach ($users as $user) {
            
            User::create($user);
        }
    }
}
