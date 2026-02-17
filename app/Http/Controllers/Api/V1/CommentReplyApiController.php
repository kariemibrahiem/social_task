<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiTrait;
use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CommentReply as ObjModel;

class CommentReplyApiController extends Controller
{
        use ApiTrait;

    public function __construct(protected ObjModel $objModel) {}

    public function store(Request $request)
    {
        try {
            
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'comment_id' => 'required|exists:comments,id',
                'text' => 'required|string'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->first(), 422, $validator->errors());
            }

            $comment = Comment::with('post')->findOrFail($request->comment_id);
            $user = Auth::user();

            if (!$user) {
                return $this->errorResponse("Unauthenticated", 401);
            }

            if ($comment->post->user_id !== $user->id) {
                return $this->errorResponse("Unauthorized. Only the post owner can reply to comments.", 403);
            }

            if (CommentReply::where('comment_id', $comment->id)->exists()) {
                return $this->errorResponse("A reply already exists for this comment.", 409);
            }

            $reply = CommentReply::create([
                'comment_id' => $comment->id,
                'user_id' => $user->id,
                'text' => $request->text
            ]);

            return $this->successResponse($reply, 201, "تم إضافة الرد بنجاح");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $reply = CommentReply::findOrFail($id);

            if ($reply->user_id !== Auth::id()) {
                return $this->errorResponse("Unauthorized.", 403);
            }

            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'text' => 'required|string'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->first(), 422);
            }

            $reply->update(['text' => $request->text]);

            return $this->successResponse($reply, 200, "تم تحديث الرد بنجاح");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $reply = CommentReply::findOrFail($id);

            if ($reply->user_id !== Auth::id()) {
                return $this->errorResponse("Unauthorized.", 403);
            }

            $reply->delete();
            return $this->successResponse([], 200, "تم حذف الرد بنجاح"); 
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function myReplies()
    {
        try {
            $user = Auth::user();
            $replies = CommentReply::with('comment')->where('user_id', $user->id)->get();

            $data = $replies->map(function ($reply) {
                return [
                    'id' => $reply->id,
                    'comment_content' => $reply->comment ? $reply->comment->content : null,
                    'post_id' => $reply->comment ? $reply->comment->post_id : null,
                    'text' => $reply->text,
                    'created_at' => $reply->created_at,
                    'updated_at' => $reply->updated_at,
                ];
            });

            return $this->successResponse($data, 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }


}
