<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use Illuminate\Routing\Route;

Route::post('/login', [AuthApiController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthApiController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout']);

    Route::apiResource('barangs', [BarangController::class]);
    Route::apiResource('peminjamans', [PeminjamanController::class]);
    Route::post('/kembalikan/{id}', [PengembalianController::class, 'kembalikan']);
});
