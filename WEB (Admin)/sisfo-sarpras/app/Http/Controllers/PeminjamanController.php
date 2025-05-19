<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index() {
        $peminjamans = Peminjaman::with('barang')->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function store(Request $request) {
        $barang = Barang::findOrFail($request->barang_id);
        if ($barang->stok >= $request->jumlah) {
            $barang->stok -= $request->jumlah;
            $barang->save();
            Peminjaman::create($request->only('barang_id', 'nama_peminjam', 'jumlah'));
        }
        return redirect('/peminjaman');
    }
}
