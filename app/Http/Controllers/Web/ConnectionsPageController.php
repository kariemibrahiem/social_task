<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use Illuminate\Support\Facades\Auth;

class ConnectionsPageController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $receivedRequests = Connection::with('sender')
            ->where('receiver_id', $userId)
            ->where('status', 'pending')
            ->get();

        $sentRequests = Connection::with('receiver')
            ->where('sender_id', $userId)
            ->where('status', 'pending')
            ->get();

        return view('pages.connections', compact('receivedRequests', 'sentRequests'));
    }
}
