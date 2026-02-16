<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Database\Seeder;

class CommentReplySeeder extends Seeder
{
    public function run(): void
    {
        $comment = Comment::with('post')->first();
        if (!$comment || !$comment->post) return;

        // reply by post owner
        CommentReply::updateOrCreate(
            ['comment_id' => $comment->id],
            [
                'user_id' => $comment->post->user_id,
                'text' => 'Thanks!',
            ]
        );
    }
}
