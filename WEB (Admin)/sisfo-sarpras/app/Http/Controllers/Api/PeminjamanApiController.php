<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PeminjamanApiController extends Controller
{
    // Ambil semua data peminjaman
    public function index()
    {
        $data = Peminjaman::with(['user', 'barang'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar peminjaman',
            'data' => $data,
        ]);
    }

    // Simpan data peminjaman baru
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal_pinjam' => 'required|date',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Get authenticated user from request (handled by route middleware)
        $user = $request->user();

        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'status' => 'Menunggu',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil diajukan',
            'data' => $peminjaman,
        ]);
    }

   public function setujui($id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    $peminjaman->status = 'Disetujui';
    $peminjaman->save();

    return response()->json(['message' => 'Peminjaman disetujui'], 200);
}


public function tolak($id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    if ($peminjaman->status != 'Menunggu') {
        return response()->json(['message' => 'Peminjaman sudah diproses sebelumnya'], 400);
    }

    $peminjaman->status = 'Ditolak';
    $peminjaman->save();

    return response()->json(['message' => 'Peminjaman ditolak']);
}


    // Alternative store method if you want to pass user_id manually
    public function storeAlternative(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'barang_id' => 'required|exists:barangs,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        $peminjaman = Peminjaman::create([
            'user_id' => $request->user_id,
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'keterangan' => $request->keterangan,
            'status' => 'Menunggu',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil diajukan',
            'data' => $peminjaman,
        ]);
    }

    // Tampilkan detail peminjaman berdasarkan ID
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['user', 'barang'])->find($id);

        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $peminjaman,
        ]);
    }

    // Perbarui status peminjaman (contohnya: dikembalikan)
   public function update(Request $request, $id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    $request->validate([
        'status' => 'required|in:Dipinjam,Dikembalikan',
        'tanggal_kembali' => 'nullable|date',
    ]);

    if ($request->status == 'Dipinjam' && $peminjaman->status != 'Dipinjam') {
        $barang = Barang::find($peminjaman->barang_id);
        $barang->stok -= $peminjaman->jumlah;
        $barang->save();
    }

    $peminjaman->update([
        'status' => $request->status,
        'tanggal_kembali' => $request->tanggal_kembali,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Status peminjaman diperbarui',
        'data' => $peminjaman,
    ]);
}

    // Hapus data peminjaman
    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $peminjaman->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data peminjaman berhasil dihapus'
        ]);
    }

    // Perbarui status peminjaman (dipakai Flutter)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Dipinjam,Barang sudah dikembalikan',
        ]);

        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'message' => 'Peminjaman tidak ditemukan'
            ], 404);
        }

        $peminjaman->status = $request->status;
        $peminjaman->save();

        return response()->json([
            'message' => 'Status berhasil diperbarui',
            'data'    => $peminjaman,
        ]);
    }

    // Get peminjaman by user (for current authenticated user)
    public function myPeminjaman(Request $request)
    {
        $user = $request->user();
        $data = Peminjaman::with(['barang'])
            ->where('user_id', $user->id)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar peminjaman Anda',
            'data' => $data,
        ]);
    }
}