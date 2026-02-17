<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        $users = [
            [
                "name" => "user",
                "email" => "user@email.com",
                "password" => "user",
                "phone" => "01111111111",   
                "image" => "testImage",
                "status" => 1,
            ],
            [
                "name" => "user2",
                "email" => "user2@email.com",
                "password" => "user2",
                "phone" => "01111111112",   
                "image" => "testImage",
                "status" => 1,
            ],
            [
                "name" => "user3",
                "email" => "user3@email.com",
                "password" => "user3",
                "phone" => "01111111113",   
                "image" => "testImage",
                "status" => 1,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
