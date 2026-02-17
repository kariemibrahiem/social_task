<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $friends = Connection::where('status', 'accepted')
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->with(['sender', 'receiver'])
            ->get()
            ->map(function ($connection) use ($userId) {
                return $connection->sender_id === $userId ? $connection->receiver : $connection->sender;
            });

        return view('pages.friends', compact('friends'));
    }
}
