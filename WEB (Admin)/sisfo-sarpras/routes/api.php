<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BarangApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\DashboardApiController;
use App\Http\Controllers\Api\PeminjamanApiController;
use App\Http\Controllers\Api\PengembalianApiController;

// Public routes (no authentication required)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [DashboardApiController::class, 'index']);
Route::get('/barangApi', [BarangApiController::class, 'getBarang']);

// Protected routes (authentication required)
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Category routes
    Route::apiResource('kategori', CategoryApiController::class);
    
    // Barang routes
    Route::apiResource('barang', BarangApiController::class);
    
    // Peminjaman routes
    Route::middleware('auth:sanctum')->group(function () {
    Route::post('/peminjaman', [PeminjamanApiController::class, 'store']);
    Route::get('/peminjaman', [PeminjamanApiController::class, 'index']);
    Route::get('/peminjaman/{id}', [PeminjamanApiController::class, 'show']);
    Route::put('/peminjaman/{id}', [PeminjamanApiController::class, 'update']);
    Route::delete('/peminjaman/{id}', [PeminjamanApiController::class, 'destroy']);
    Route::put('/peminjaman/{id}/status', [PeminjamanApiController::class, 'updateStatus']);
    Route::put('/peminjaman/{id}/setujui', [PeminjamanApiController::class, 'setujui']);
    Route::put('/peminjaman/{id}/tolak', [PeminjamanApiController::class, 'tolak']);
    });
    // Pengembalian routes
    Route::post('/pengembalian', [PengembalianApiController::class, 'store']);
    Route::get('/riwayat-pengembalian', [PengembalianApiController::class, 'riwayat']);
    Route::get('/riwayat-pengembalian/{user_id}', [PengembalianApiController::class, 'riwayatUser']);
});

// Alternative: If you want some peminjaman routes to be public
// Route::get('/peminjaman', [PeminjamanApiController::class, 'index']); // Public - view all
// Route::get('/peminjaman/{id}', [PeminjamanApiController::class, 'show']); // Public - view specific