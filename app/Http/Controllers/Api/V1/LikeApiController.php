<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiTrait;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeApiController extends Controller
{
        use ApiTrait;

    public function toggle(Request $request, $id)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return $this->errorResponse("Unauthenticated", 401);
            }

            $post = Post::find($id);
            if (!$post) {
                return $this->errorResponse("Post not found", 404);
            }

            $like = Like::where('post_id', $id)->where('user_id', $user->id)->first();
            $liked = false;

            if ($like) {
                $like->delete();
                $liked = false;
            } else {
                
                Like::create([
                    'post_id' => $id,
                    'user_id' => $user->id
                ]);
                $liked = true;
            }

            $likesCount = Like::where('post_id', $id)->count();

            return $this->successResponse([
                'post_id' => $id,
                'liked' => $liked,
                'likes_count' => $likesCount
            ], 200, "تمت العملية بنجاح");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }


}
