<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) return;

        Post::create([
            'user_id' => $user->id,
            'content' => 'My first post!',
            'image' => null,
        ]);
    }
}
