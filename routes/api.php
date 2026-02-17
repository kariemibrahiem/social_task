<?php

use App\Http\Controllers\Api\V1\CommentApiController;
use App\Http\Controllers\Api\V1\CommentReplyApiController;
use App\Http\Controllers\Api\V1\ConnectionApiController;
use App\Http\Controllers\Api\V1\LikeApiController;
use App\Http\Controllers\Api\V1\PostApiController;
use App\Http\Controllers\v1\AdminController;
use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\AuthUserController;
use App\Http\Controllers\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("user-login", [AuthUserController::class, "login"]);
Route::post("user-regist", [AuthUserController::class, "regist"]);

Route::post("login", [AuthController::class, "login"]);
Route::post("regist", [AuthController::class, "regist"]); 
Route::post("otp-check", [AuthController::class, "otpCheck"]);

Route::group(["middleware" => "auth:sanctum"], function () {
    
    Route::get("user-getDate", [UserController::class, "getDate"]);
    Route::post("user-update/{id}", [UserController::class, "update"]); 
    Route::delete("user-destroy/{id}", [UserController::class, "destroy"]); 
    Route::post("user-logout", [AuthController::class, "logout"]);

    Route::prefix('posts')->group(function () {
        Route::get('/', [PostApiController::class, 'getData']);
        Route::get('/{id}', [PostApiController::class, 'getById']);
        Route::post('/', [PostApiController::class, 'store']);
        Route::post('/{id}', [PostApiController::class, 'update']); 
        Route::delete('/{id}', [PostApiController::class, 'destroy']);
    });

    Route::prefix('comments')->group(function () {
        Route::get('/my', [CommentApiController::class, 'myComments']);
        Route::get('/post/{post_id}', [CommentApiController::class, 'getByPost']);
    });

    Route::prefix('comments')->group(function () {
        Route::get('/', [CommentApiController::class, 'getData']);
        Route::get('/{id}', [CommentApiController::class, 'getById']);
        Route::post('/', [CommentApiController::class, 'store']);
        Route::put('/{id}', [CommentApiController::class, 'update']);
        Route::delete('/{id}', [CommentApiController::class, 'destroy']);
    });

    Route::prefix('connections')->group(function () {
        Route::get("my-connections" , [ConnectionApiController::class,"myConnections"]);
        Route::post('/{id}/accept', [ConnectionApiController::class, 'accept']);
        Route::post('/{id}/reject', [ConnectionApiController::class, 'reject']);
    });
});
