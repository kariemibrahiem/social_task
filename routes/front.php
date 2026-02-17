<?php

use App\Http\Controllers\Web\WebAuthController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\FriendsController;
use App\Http\Controllers\Web\ConnectionsPageController;
use App\Http\Controllers\Web\MyPostsController;
use App\Http\Controllers\Web\PagesController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\PostLikeController;
use App\Http\Controllers\Web\PostCommentController;
use App\Http\Controllers\Web\NotificationsController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\WebPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('front.home');

Route::group(["prefix" => ""], function () {
    Route::get("/login", [WebAuthController::class, "login"])->name("front.login");
    Route::post("/login-check", [WebAuthController::class, "login_check"])->name("front.login_check");
    Route::get("/register", [WebAuthController::class, "register"])->name("front.register");
    Route::post("/register-done", [WebAuthController::class, "register_check"])->name("front.register_check");
});

Route::middleware(['webAuth'])->group(function () {
    Route::get('/friends', [FriendsController::class, 'index'])->name('front.friends');
    Route::get('/front-connections', [ConnectionsPageController::class, 'index'])->name('front.connections');
    Route::get('/front-posts', [MyPostsController::class, 'index'])->name('front.posts');
    Route::post("/logout", [WebAuthController::class, "logout"])->name("front.logout");

    Route::post('/connections/send/{user}', [App\Http\Controllers\Web\ConnectionRequestController::class, 'send'])->name('front.connections.send');
    Route::post('/connections/{connection}/accept', [App\Http\Controllers\Web\ConnectionRequestController::class, 'accept'])->name('front.connections.accept');
    Route::post('/connections/{connection}/reject', [App\Http\Controllers\Web\ConnectionRequestController::class, 'reject'])->name('front.connections.reject');

    Route::post('/posts/{post}/like', [PostLikeController::class, 'toggle'])->name('front.posts.like');

    Route::post('/posts/{post}/comments', [PostCommentController::class, 'store'])->name('front.posts.comments.store');

    Route::get('/notifications', [NotificationsController::class, 'index'])->name('front.notifications');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('front.profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('front.profile.update');

    Route::post('/posts', [WebPostController::class, 'store'])->name('front.posts.store');
});

Route::get('/pages', [PagesController::class, 'index'])->name('front.pages');
Route::get('/contact', [ContactController::class, 'index'])->name('front.contact');
