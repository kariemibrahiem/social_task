<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Traits\PhotoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use PhotoTrait;
    public function edit()
    {
        $user = Auth::user();
        return view('pages.profile_edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'phone'    => 'nullable|string|unique:users,phone,' . $user->id,
            'image'    => 'nullable|image|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->phone  = $request->phone;

        if ($request->hasFile('image')) {
            $user->image = $this->saveImage($request->file('image'), 'users');
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
