<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    public function run(): void
    {
        $post = Post::first();
        $user = User::first();

        if (!$post || !$user) return;

        Like::updateOrCreate(
            ['post_id' => $post->id, 'user_id' => $user->id],
            []
        );
    }
}
