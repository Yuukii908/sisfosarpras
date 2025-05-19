<?php

use App\Http\Controllers\API\PeminjamanApiController;
use App\Http\Controllers\API\PengembalianApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

// Redirect root to login
Route::get('/', function () {
    return redirect('/login');
});

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// After login
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

});

Route::resource('model-barang', App\Http\Controllers\ModelBarangController::class);
Route::resource('users', UserController::class);
Route::resource('peminjaman', PeminjamanApiController::class);
Route::resource('pengembalian', PengembalianApiController::class);