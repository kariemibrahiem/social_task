<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiTrait;
use App\Models\User;
use App\Traits\FirebaseNotification;
use App\Traits\PhotoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{
    use ApiTrait, FirebaseNotification, PhotoTrait;

    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getDate()
    {
        $user = $this->user->where("id", auth("user-api")->id())->get();

        return $this->successResponse([
            'user' => $user
        ]);
    }

    public function show($id)
    {

        $user = $this->user->find($id);

        if (!$user) {
            return $this->errorResponse('User not found', 404);
        }

        return $this->successResponse(['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = $this->user->findOrFail($id);

            $request->validate([
                "name" => "sometimes|string|max:255",
                "email" => "sometimes|email|unique:users,email," . $user->id,
                "password" => "nullable|string|min:6|confirmed",
                "image" => "nullable|image|max:2048",
            ]);

            $path = $user->image;
            if ($request->hasFile('image')) {
                $path = $this->saveImage($request->file('image'), 'users');
            }

            $user->update([
                "name" => $request->name ?? $user->name,
                "password" => $request->password ? Hash::make($request->password) : $user->password,
                "code" => $request->code ?? $user->code,
                "email" => $request->email ?? $user->email,
                "status" => $request->status ?? $user->status,
                "image" => $path,
            ]);

            return $this->successResponse(['user' => $user], "User updated successfully");
        } catch (Exception $e) {
            return $this->errorResponse("Update failed: " . $e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = $this->user->findOrFail($id);
            $user->delete();

            return $this->successResponse([], "User deleted successfully");
        } catch (Exception $e) {
            return $this->errorResponse("Delete failed: " . $e->getMessage(), 500);
        }
    }
}
