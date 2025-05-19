<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BarangController;
use App\Http\Controllers\API\KondisiApiController;
use App\Http\Controllers\API\KategoriBarangApiController;
use App\Http\Controllers\API\BarangApiController;
use App\Http\Controllers\API\PeminjamanApiController;
use App\Http\Controllers\API\PengembalianApiController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/peminjaman', [PeminjamanApiController::class, 'store']);
    // route lain yang butuh user login
});

// API CRUD Barang
Route::apiResource('kategori-barang', KategoriBarangApiController::class);
Route::apiResource('barang', BarangApiController::class);
Route::apiResource('peminjaman', PeminjamanApiController::class);
Route::apiResource('pengembalian', PengembalianApiController::class);

// Optional: Routes untuk laporan
Route::get('/laporan/stok-barang', [BarangApiController::class, 'laporanStok']);
Route::get('/laporan/peminjaman', [PeminjamanApiController::class, 'laporanPeminjaman']);
Route::get('/laporan/pengembalian', [PengembalianApiController::class, 'laporanPengembalian']);