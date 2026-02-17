<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Traits\PhotoTrait;
use Illuminate\Http\Request;

class WebPostController extends Controller
{
    use PhotoTrait;

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:1',
            'image'   => 'nullable|image|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('image')) {
            $path = $this->saveImage($request->file('image'), 'posts');
        }

        Post::create([
            'user_id' => auth()->id(),
            'content' => $request->content,
            'image'   => $path,
        ]);

        return redirect()->back()->with('success', 'Post published successfully!');
    }
}
