<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiTrait;
use App\Models\User;
use Illuminate\Http\Request;

class AuthUserController extends Controller
{
    use ApiTrait;

    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email"    => "required|email",
            "password" => "required"
        ]);

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('API Token')->plainTextToken;
            return $this->successResponse(['token' => "Bearer " . $token, 'user' => auth()->user()], 'Login successful');
        }

        return $this->errorResponse([], 'Invalid credentials', 401);
    }

    public function regist(Request $request)
    {
        $data = $request->validate([
            "name"     => "required|string|max:255",
            "email"    => "required|email|unique:users,email",
            "password" => "required|min:6|confirmed"
        ]);

        $user = $this->user->create($data);

        $token = $user->createToken('API Token')->plainTextToken;

        return $this->successResponse(['user' => $user, 'token' => "Bearer " . $token], 'User registered successfully');
    }
}
