<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowEdgeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupFollowEdgeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MailSettingsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReactionImageController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PostReactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home Route
Route::get('/', HomeController::class)->name('home');

// Insert here all the routes that need to be authenticated.
Route::middleware(['auth', 'verified'])->group(function () {

    // User profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/propic', [ProfileController::class, 'updatePropic'])->name('profile.updatePropic');
    Route::patch('/profile/mail-settings', [ProfileController::class, 'updateMailSettings'])->name('profile.mail');
    Route::get('/profile/mail-settings', MailSettingsController::class)->name('profile.mail');

    // Group routes
    Route::get('/create-group', [GroupController::class, 'create'])->name('group.create');
    Route::post('/create-group', [GroupController::class, 'store'])->name('group.store');

    // Image routes
    Route::post('/image', [ImageController::class, 'store'])->name('image.store');

    // Post routes
    Route::get('/create-post/{name}', [PostController::class, 'create'])->name('post.create');
    Route::post('/create-post', [PostController::class, 'store'])->name('post.store');

    // FollowEdge routes
    Route::post('/user/follow', [FollowEdgeController::class, 'store'])->name('user.follow');
    Route::post('/user/unfollow', [FollowEdgeController::class, 'delete'])->name('user.unfollow');

    // FollowEdge routes
    Route::post('/group/follow', [GroupFollowEdgeController::class, 'store'])->name('group.follow');
    Route::post('/group/unfollow', [GroupFollowEdgeController::class, 'delete'])->name('group.unfollow');

    // Comment routes
    Route::post('/create-comment', [CommentController::class, 'store'])->name('comment.store');
    
    // Notification routes
    Route::get('/notification/read/{id}', [NotificationController::class, 'markAsRead'])->name('notification.read');
    Route::get('/notification/readall', [NotificationController::class, 'readAll'])->name('notification.readall');
    Route::get('/notification-list', [NotificationController::class, 'getNotifications'])->name('notification.list');
    Route::get('/notifications', [NotificationController::class, 'showNotificationsPage'])->name('notification.show');

    // PostReaction routes
    Route::post('/post/react', [PostReactionController::class, 'store'])->name('post-reaction.store');

});

// User page routes
Route::get('/user/{username}', [UserPageController::class, 'show'])->name('userpage.show');
Route::get('/user/following/{username}', [UserPageController::class, 'getFollowingInfo'])->name('userpage.info.following');
Route::get('/user/followers/{username}', [UserPageController::class, 'getFollowersInfo'])->name('userpage.info.followers');

// Group routes
Route::get('/group/{name}', [GroupController::class, 'show'])->name('group.show');

// Post routes
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');

// Image routes
Route::get('/image/{id}', [ImageController::class, 'get'])->name('image.get');

// Search routes
Route::get('/search', SearchController::class)->name('search.show');

// Comment routes
Route::get('/comments/{post}', [CommentController::class, 'get'])->name('comments.get');

require __DIR__.'/auth.php';
