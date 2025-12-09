<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogReactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Models\Blog;
use Illuminate\Support\Facades\Route;
use Termwind\Components\Raw;

Route::get('/', function () {
    $allBlogs = Blog::with('category', 'author')->orderBy('created_at', 'desc')->get();
    return view('home', compact('allBlogs'));
})->name('home');
Route::get('single/{slug}', function ($slug) {
    // Get single blog details here
    $blogSingle = Blog::with('category', 'author', 'comments')->where('slug', $slug)->first();
    return view('single', compact('blogSingle'));
})->name('blog.single');

// User Controller Routes
Route::controller(UserController::class)->group(function () {
    Route::get('register', 'register')->name('register.create')->middleware('user.login');
    Route::post('register/store', 'store')->name('register.store');

    Route::get('login', 'loginCreate')->name('login.create')->middleware('user.login');
    Route::post('login', 'login')->name('login');

    Route::get('logout', 'logout')->name('logout');
});

// Category Routes
Route::controller(CategoryController::class)->middleware('user.category')->group(function () {
    Route::get('categories', 'index')->name('category.index');
    Route::get('categories/create', 'create')->name('category.create');
    Route::post('categories', 'store')->name('category.store');
    Route::get('categories/{slug}/edit', 'edit')->name('category.edit');
    Route::put('categories/{slug}', 'update')->name('category.update');
    Route::delete('categories/{id}', 'destroy')->name('category.destroy');
});

// Blog Routes
Route::controller(BlogController::class)->middleware('user.logout')->group(function () {
    Route::get('blogs', 'index')->name('blog.index');
    Route::get('blogs/create', 'create')->name('blog.create');
    Route::post('blogs', 'store')->name('blog.store');
    Route::get('blogs/{slug}', 'show')->name('blog.show');
    Route::get('blogs/{slug}/edit', 'edit')->name('blog.edit');
    Route::put('blogs/{slug}', 'update')->name('blog.update');
    Route::delete('blogs/{slug}', 'destroy')->name('blog.destroy');
});

// Comment Routes
Route::controller(CommentController::class)->middleware('user.logout')->group(function () {
    Route::post('comment', 'store')->name('comment.store');
    Route::post('comment/reply', 'commentReply')->name('comment.reply');

    Route::get('post/{slug}/comments', 'postComment')->name('post.comment');
    Route::post('commnet/{id}/status', 'commentStatus')->name('comment.status');
});

// Blog Like Reaction
Route::controller(BlogReactionController::class)->middleware('user.logout')->group(function () {
    Route::post('reaction', 'reaction')->name('name.reaction');
});
