<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BarangApiController;
use App\Http\Controllers\Api\PeminjamanApiController;
use App\Http\Controllers\Api\PengembalianApiController;
use App\Http\Controllers\Api\DashboardApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Models\Category;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'me']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('barang', BarangApiController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('kategori', CategoryApiController::class);
    Route::apiResource('peminjaman', PeminjamanApiController::class);
    Route::apiResource('pengembalian', PengembalianApiController::class);
});
