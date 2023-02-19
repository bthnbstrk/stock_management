<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {

        $users = [
            [
                "name" => "Batuhan Çiloğlu",
                "email" =>"batuhan@ciloglu.com",
                "email_verified_at" => date("Y-m-d H:i:s"),
                "password" => Hash::make("ciloglu12"),
            ],
            [
                "name" => "Selim Çiloğlu",
                "email" =>"selim@ciloglu.com",
                "email_verified_at" => date("Y-m-d H:i:s"),
                "password" => Hash::make("ciloglu12"),
            ],
            [
                "name" => "Murat Çiloğlu",
                "email" =>"murat@ciloglu.com",
                "email_verified_at" => date("Y-m-d H:i:s"),
                "password" => Hash::make("ciloglu12"),
            ],
            [
                "name" => "Gökhan Çiloğlu",
                "email" =>"gökhan@ciloglu.com",
                "email_verified_at" => date("Y-m-d H:i:s"),
                "password" => Hash::make("ciloglu12"),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

    }
}
