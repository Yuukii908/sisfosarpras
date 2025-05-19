<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'jumlahBarang' => \App\Models\Barang::count(),
            'jumlahDipinjam' => \App\Models\Peminjaman::whereNull('tanggal_kembali')->count(),
            'jumlahTersedia' => \App\Models\Barang::sum('stok'),
            'jumlahTerlambat' => \App\Models\Peminjaman::whereNull('tanggal_kembali')
                ->where('tanggal_pengembalian', '<', now())->count(),
        ]);
    }
    }
