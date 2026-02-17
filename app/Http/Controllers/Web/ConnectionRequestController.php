<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnectionRequestController extends Controller
{
    public function send(Request $request, User $user)
    {
        $senderId = Auth::id();
        $receiverId = $user->id;

        if ($senderId == $receiverId) {
            return back()->with('error', 'You cannot connect with yourself.');
        }

        $existingConnection = Connection::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', $senderId);
        })->first();

        if ($existingConnection) {
            if ($existingConnection->status == 'accepted') {
                return back()->with('info', 'You are already friends.');
            }
            if ($existingConnection->status == 'pending') {
                return back()->with('info', 'Connection request is already pending.');
            }
            
            return back()->with('info', 'Connection request already handled.');
        }

        Connection::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Connection request sent successfully.');
    }

    public function accept(Connection $connection)
    {
        if ($connection->receiver_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $connection->update(['status' => 'accepted']);

        return back()->with('success', 'Connection request accepted.');
    }

    public function reject(Connection $connection)
    {
        if ($connection->receiver_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $connection->update(['status' => 'rejected']);

        return back()->with('success', 'Connection request rejected.');
    }
}
