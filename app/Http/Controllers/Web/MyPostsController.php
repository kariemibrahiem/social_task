<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class MyPostsController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())
            ->with(['user', 'comments.user', 'comments.reply', 'likes'])
            ->latest()
            ->get();

        return view('pages.posts', compact('posts'));
    }
}
