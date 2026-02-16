<?php

use App\Http\Controllers\Api\V1\CommentApiController;
use App\Http\Controllers\Api\V1\CommentReplyApiController;
use App\Http\Controllers\Api\V1\ConnectionApiController;
use App\Http\Controllers\Api\V1\PostApiController;
use App\Http\Controllers\v1\AdminController;
use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\AuthUserController;
use App\Http\Controllers\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("user-login", [AuthUserController::class, "login"]);
Route::post("user-regist", [AuthUserController::class, "regist"]);
Route::post("user-checkOtp", [AuthUserController::class, "checkOtp"]);
Route::post("login", [AuthController::class, "login"]);
Route::post("user-regist", [AuthController::class, "regist"]);
Route::post("user-otp", [AuthController::class, "otpCheck"]);

Route::group(["middleware" => "auth:sanctum"], function () {
    Route::get("user-getDate", [UserController::class, "getDate"]);
    Route::post("user-update", [UserController::class, "updateUser"]);
    Route::delete("user-destroy", [UserController::class, "destroyUser"]);
    Route::post("user-logout", [AuthController::class, "logout"]);
    // admin routes 
    Route::get("admin-getDate", [AdminController::class, "getDate"]);
    Route::post("admin-create", [AdminController::class, "store"]);
    Route::post("admin-update", [AdminController::class, "update"]);
    Route::delete("admin-destroy", [AdminController::class, "destroy"]);

    // posts 
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostApiController::class, 'getData']);
        Route::get('/{id}', [PostApiController::class, 'getById']);
        Route::post('/', [PostApiController::class, 'store']);
        Route::put('/{id}', [PostApiController::class, 'update']);
        Route::delete('/{id}', [PostApiController::class, 'destroy']);
    });
    
    // comments 
    Route::prefix('comments')->group(function () {
        Route::get('/', [CommentApiController::class, 'getData']);
        Route::get('/{id}', [CommentApiController::class, 'getById']);
        Route::post('/', [CommentApiController::class, 'store']);
        Route::put('/{id}', [CommentApiController::class, 'update']);
        Route::delete('/{id}', [CommentApiController::class, 'destroy']);
    });
    
    // connections 
    Route::prefix('connections')->group(function () {
        Route::get('/', [ConnectionApiController::class, 'getData']);
        Route::post('/', [ConnectionApiController::class, 'store']);
        Route::delete('/{id}', [ConnectionApiController::class, 'destroy']);
    });
});







