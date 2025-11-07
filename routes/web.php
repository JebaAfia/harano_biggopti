<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;


Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/', [PostController::class, 'recentPosts'])->name('index');
Route::get('/', [PostController::class, 'funFacts'])->name('index');
Route::get('/all_posts', [PostController::class, 'allPosts'])->name('post.all_posts');
Route::get('/posts_details/{id}', [PostController::class, 'postsDetails'])->name('post.view_post_details');

Route::post('/send-email', [ContactController::class, 'sendEmail'])->name('send.email');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::get('/new_post', [PostController::class, 'newPost'])->name('post.new_post');
    Route::post('/new_post', [PostController::class, 'postNewPost'])->name('post.post_new_post');
});

Route::middleware('admin')->group(function () {
    Route::get('/add_category', [CategoryController::class, 'addCategory'])->name('admin.category.add_category');
    Route::post('/add_category', [CategoryController::class, 'postAddCategory'])->name('admin.category.post_add_category');
    Route::get('/view_category', [CategoryController::class, 'viewCategory'])->name('admin.category.view_category');
    Route::get('/update_category/{id}', [CategoryController::class, 'updateCategory'])->name('admin.category.update_category');
    Route::put('/update_category/{id}', [CategoryController::class, 'postUpdateCategory'])->name('admin.category.post_update_category');
    Route::delete('/delete_category/{id}', [CategoryController::class, 'deleteCategory'])->name('admin.category.delete_category');

    Route::get('/add_post', [PostController::class, 'addPost'])->name('admin.post.add_post');
    Route::post('/add_post', [PostController::class, 'postAddPost'])->name('admin.post.post_add_post');
    Route::get('/view_post', [PostController::class, 'viewPost'])->name('admin.post.view_post');
    Route::get('/update_post/{id}', [PostController::class, 'updatePost'])->name('admin.post.update_post');
    Route::put('/update_post/{id}', [PostController::class, 'postUpdatePost'])->name('admin.post.post_update_post');
    Route::delete('/delete_post/{id}', [PostController::class, 'deletePost'])->name('admin.post.delete_post');





});

require __DIR__.'/auth.php';
