<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowEdgeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\SearchController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Insert here all the routes that need to be authenticated.
Route::middleware('auth')->group(function () {

    // User profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Group routes
    Route::get('/create-group', [GroupController::class, 'create'])->name('group.create');
    Route::post('/create-group', [GroupController::class, 'store'])->name('group.store');

    // Image routes
    Route::post('/image', [ImageController::class, 'store'])->name('image.store');

    // Post routes
    Route::get('/create-post/{name}', [PostController::class, 'create'])->name('post.create');
    Route::post('/create-post', [PostController::class, 'store'])->name('post.store');

    // FollowEdge routes
    Route::post('/follow', [FollowEdgeController::class, 'store'])->name('follow');
    Route::post('/unfollow', [FollowEdgeController::class, 'delete'])->name('unfollow');

    // Comment routes
    Route::post('/create-comment', [CommentController::class, 'store'])->name('comment.store');

});

// User page routes
Route::get('/user/{username}', [UserPageController::class, 'show'])->name('userpage.show');

// Group routes
Route::get('/group/{name}', [GroupController::class, 'show'])->name('group.show');

// Post routes
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');

// Image routes
Route::get('/image/{id}', [ImageController::class, 'get'])->name('image.get');

// Search routes
Route::get('/search', [SearchController::class, 'show'])->name('search.show');

require __DIR__.'/auth.php';
