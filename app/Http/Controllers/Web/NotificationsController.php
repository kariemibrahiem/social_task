<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $commentNotifications = Comment::whereHas('post', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->where('user_id', '!=', $userId)
            ->with(['user', 'post'])
            ->latest()
            ->get();

        $replyNotifications = CommentReply::whereHas('comment', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->where('user_id', '!=', $userId)
            ->with(['user', 'comment.post', 'comment.user'])
            ->latest()
            ->get();

        $connectionRequests = \App\Models\Connection::with('sender')
            ->where('receiver_id', $userId)
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('pages.notifications', compact('commentNotifications', 'replyNotifications', 'connectionRequests'));
    }
}
