<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Models\Blog;

Route::get('/', function () {
    $allBlogs = Blog::with('category', 'author')->orderBy('created_at', 'desc')->get();
    return view('home', compact('allBlogs'));
})->name('home');

// User Controller Routes
Route::controller(UserController::class)->group(function () {
    Route::get('/register', 'register')->name('register.create')->middleware('user.login');
    Route::post('/register/store', 'store')->name('register.store');

    Route::get('/login', 'loginCreate')->name('login.create')->middleware('user.login');
    Route::post('/login', 'login')->name('login');

    Route::get('/logout', 'logout')->name('logout');
});

// Category Routes
Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('category.index');
    Route::get('/categories/create', 'create')->name('category.create');
    Route::post('/categories', 'store')->name('category.store');
    Route::get('/categories/{slug}/edit', 'edit')->name('category.edit');
    Route::put('/categories/{slug}', 'update')->name('category.update');
    Route::delete('/categories/{id}', 'destroy')->name('category.destroy');
});

// Blog Routes
Route::controller(BlogController::class)->middleware('user.logout')->group(function () {
    Route::get('/blogs', 'index')->name('blog.index');
    Route::get('/blogs/create', 'create')->name('blog.create');
    Route::post('/blogs', 'store')->name('blog.store');
    Route::get('/blogs/{id}', 'show')->name('blog.show');
    Route::get('/blogs/{id}/edit', 'edit')->name('blog.edit');
    Route::put('/blogs/{id}', 'update')->name('blog.update');
    Route::delete('/blogs/{id}', 'destroy')->name('blog.destroy');
});