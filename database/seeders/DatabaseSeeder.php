<?php

namespace Database\Seeders;

use App\Models\Admin;

use App\Models\User;
use App\Models\UserMail;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
        ]);
     
        Admin::create([
            "user_name" => "admin",
            "email" => "admin@admin.com",
            "password" => "admin",
            "code" => "admin",
            "phone" => "01000000000",
            "image" => "testImage"
        ]);



        $user = User::create([
            "name" => "user",
            "email" => "user@email.com",
            "password" => "user",
            "phone" => "01111111111",   
            "image" => "testImage",
            "status" => 1,
        ]);


    

        Admin::latest()->first()->assignRole("super_admin");
    }
}
