<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function toggle(Request $request, Post $post)
    {
        $userId = auth()->id();

        $like = Like::where('post_id', $post->id)
            ->where('user_id', $userId)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            
            Like::create([
                'post_id' => $post->id,
                'user_id' => $userId,
            ]);
        }

        return redirect()->back();
    }
}
