<?php

namespace App\Http\Controllers\Admin\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Connection;
use App\Models\Post;
use App\Models\User;
use App\Traits\WeatherTrait;

class Analytics extends Controller
{
    use WeatherTrait;

    protected User $user;
    protected Admin $admin;

    public function __construct(User $user, Admin $admin)
    {
        $this->user = $user;
        $this->admin = $admin;
    }

    public function index()
    {

        $data = $this->GetWeather(30.5503, 31.0106);

        $usersCount = $this->user->count();
        $adminsCount = $this->admin->count();
        $postsCount = Post::count();
        $connectionsCount = Connection::where('status', 'accepted')->count();
        $latestUsers = $this->user->latest()->take(3)->get();

        return view('content.dashboard.dashboards-analytics', compact('usersCount', 'data', 'adminsCount', 'postsCount', 'connectionsCount', 'latestUsers'));
    }
}
