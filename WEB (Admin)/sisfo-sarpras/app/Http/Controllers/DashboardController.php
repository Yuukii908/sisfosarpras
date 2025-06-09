<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    $jumlah_barang = Barang::sum('stok');
    $jumlah_barang_dipinjam = Peminjaman::where('status', 'dipinjam')->sum('jumlah');
    $jumlah_barang_dikembalikan = Peminjaman::where('status', 'dikembalikan')->sum('jumlah');
    $jumlah_user_online = User::where('is_online', true)->count(); 

    return view('dashboard', compact(
        'jumlah_barang',
        'jumlah_barang_dipinjam',
        'jumlah_barang_dikembalikan',
        'jumlah_user_online'
    ));
}

}