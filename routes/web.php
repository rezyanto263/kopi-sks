<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Landing page
Route::get('/', [ProductController::class, 'index'])->name('landing.page');
// Detail produk
Route::get('/produk', [ProdukController::class, 'show']);
// Profile
Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');

// Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');
