<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategoryController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('post-login');
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/barang', BarangController::class);
    Route::resource('/barang', BarangController::class);

    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);

    Route::get('/pengembalian', [PengembalianController::class, 'index']);
    Route::post('/pengembalian', [PengembalianController::class, 'store']);

    
});

// Route::get('/index', function (){
//     return view('category.index');
// });

Route::get('/categories/index', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/categories/edit',[CategoryController::class, 'edit'])->name('category.edit');
Route::resource('/kategori', CategoryController::class);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');