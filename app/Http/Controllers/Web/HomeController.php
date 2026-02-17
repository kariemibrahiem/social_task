<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Post::with(['user', 'comments.user', 'comments.reply', 'likes'])
            ->latest()
            ->get();

        $stats = [
            'friends' => 0,
            'connections' => 0, 
            'posts' => 0,
            'comments' => 0,
        ];

        $connectionStatuses = [];

        if (auth()->check()) {
            $userId = auth()->id();

            $stats['friends'] = \App\Models\Connection::where('status', 'accepted')
                ->where(function ($query) use ($userId) {
                    $query->where('sender_id', $userId)
                        ->orWhere('receiver_id', $userId);
                })
                ->count();

            $stats['connections'] = \App\Models\Connection::where('receiver_id', $userId)
                ->where('status', 'pending')
                ->count();

            $stats['posts'] = \App\Models\Post::where('user_id', $userId)->count();

            $stats['comments'] = \App\Models\Comment::where('user_id', $userId)->count();

            $connections = \App\Models\Connection::where('sender_id', $userId)
                ->orWhere('receiver_id', $userId)
                ->get();

            foreach ($connections as $conn) {
                $otherId = ($conn->sender_id == $userId) ? $conn->receiver_id : $conn->sender_id;
                $connectionStatuses[$otherId] = $conn->status;
            }
        }

        $popularUsers = \App\Models\User::query();
        if (auth()->check()) {
            $popularUsers->where('id', '!=', auth()->id());
        }
        $popularUsers = $popularUsers->latest()->take(10)->get();

        return view('web.pages.home', compact('posts', 'stats', 'popularUsers', 'connectionStatuses'));
    }

    public function about()
    {
        if (view()->exists('web.pages.about')) {
            return view('web.pages.about');
        }

        abort(404);
    }

    public function projects()
    {
        if (view()->exists('web.pages.projects')) {
            return view('web.pages.projects');
        }

        abort(404);
    }

    public function blog()
    {
        if (view()->exists('web.pages.blog')) {
            return view('web.pages.blog');
        }

        abort(404);
    }

    public function contact()
    {
        if (view()->exists('web.pages.contact')) {
            return view('web.pages.contact');
        }

        return redirect()->route('front.home', []);
    }
}
