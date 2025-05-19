<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanApiController extends Controller
{
    public function index()
    {
        return response()->json(Peminjaman::with(['user', 'barang'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $userId = Auth::check() ? Auth::id() : 1;
        // fallback ke user id 1 jika belum login

        $peminjaman = Peminjaman::create([
            'user_id' => $userId,
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam',
        ]);
        

        return response()->json($peminjaman, 201);
    }

    public function show($id)
    {
        return response()->json(Peminjaman::with(['user', 'barang'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update($request->all());
        return response()->json($peminjaman);
    }

    public function destroy($id)
    {
        Peminjaman::destroy($id);
        return response()->json(null, 204);
    }

    public function laporanPeminjaman()
    {
        return response()->json(Peminjaman::with(['user', 'barang'])->get());
    }
}
