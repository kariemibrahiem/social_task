<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    public function run(): void
    {
        $post = Post::first();
        $user = User::first();

        if (!$post || !$user) return;

        Comment::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'content' => 'Nice post!',
        ]);
    }
}
