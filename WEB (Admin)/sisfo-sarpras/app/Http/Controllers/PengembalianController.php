<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Barang;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
   public function index()
{
    $pengembalians = Pengembalian::with('barang')->get();

    return view('pengembalian.index', compact('pengembalians'));
}
    public function store(Request $request) {
        $barang = Barang::findOrFail($request->barang_id);
        $barang->stok += $request->jumlah;
        $barang->save();
        Pengembalian::create($request->only('barang_id', 'nama_pengembali', 'jumlah'));
        return redirect('/pengembalian');
    }
}
