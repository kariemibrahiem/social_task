<?php

namespace Database\Seeders;

use App\Models\Admin;

use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            PostSeeder::class,
            CommentsSeeder::class,
            CommentReplySeeder::class,
            LikeSeeder::class,
            ConnectionSeeder::class,
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
            "phone" => "011111111223",   
            "image" => "testImage",
            "status" => 1,
        ]);

        Admin::latest()->first()->assignRole("super_admin");
    }
}
