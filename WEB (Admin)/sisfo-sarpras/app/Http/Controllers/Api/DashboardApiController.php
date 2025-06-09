<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;

class DashboardApiController extends Controller
{
    public function index()
    {
        $data = [
            'total_barang' => Barang::count(),
            'total_peminjaman' => Peminjaman::count(),
            'total_pengembalian' => Pengembalian::count(),
            'total_user' => User::count()
        ];

        return response()->json([
            'success' => true,
            'message' => 'Data dashboard berhasil diambil.',
            'data' => $data
        ]);
    }
}
