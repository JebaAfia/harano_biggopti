<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->group(function () {
    Route::get('/add_category', [CategoryController::class, 'addCategory'])->name('admin.category.add_category');
    Route::post('/add_category', [CategoryController::class, 'postAddCategory'])->name('admin.category.post_add_category');
    Route::get('/view_category', [CategoryController::class, 'viewCategory'])->name('admin.category.view_category');
    Route::get('/update_category/{id}', [CategoryController::class, 'updateCategory'])->name('admin.category.update_category');
    Route::put('/update_category/{id}', [CategoryController::class, 'postUpdateCategory'])->name('admin.category.post_update_category');
    Route::delete('/delete_category/{id}', [CategoryController::class, 'deleteCategory'])->name('admin.category.delete_category');
});

require __DIR__.'/auth.php';
