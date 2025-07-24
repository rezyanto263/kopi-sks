<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProductController;


Route::get('/', [ProductController::class, 'index'])->name('home');


/**
 * Unauthenticated Routes
 */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

/**
 * Authenticated User Routes
 */
Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');

    Route::get('/products/{product}', [ProductController::class, 'showProductDetailView'])->name('products.detail');
});


/**
 * Authenticated Admin Routes
 */
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/admin/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/admin/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
});
