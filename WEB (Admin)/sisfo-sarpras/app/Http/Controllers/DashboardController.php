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
        $jumlah_barang = Barang::count();
        $jumlah_peminjaman = Peminjaman::count();
        $jumlah_pengembalian = Pengembalian::count();
        $jumlah_user = User::count();

        return view('dashboard', compact(
            'jumlah_barang',
            'jumlah_peminjaman',
            'jumlah_pengembalian',
            'jumlah_user',
        ));
    }
}