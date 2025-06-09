<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class PengembalianApiController extends Controller
{
    private $maksimalPinjam = 3; 
    private $dendaPerHari = 1000; 

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'peminjaman_id' => 'required|exists:peminjamans,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $peminjaman = Peminjaman::find($request->peminjaman_id);

        if ($peminjaman->status === 'dikembalikan') {
            return response()->json([
                'success' => false,
                'message' => 'Barang sudah dikembalikan sebelumnya.'
            ], 400);
        }

        // Update status & tanggal kembali
        $peminjaman->status = 'dikembalikan';
        $peminjaman->tanggal_kembali = Carbon::now();
        $peminjaman->save();

        // Tambah stok barang
        $barang = Barang::find($peminjaman->barang_id);
        if ($barang) {
            $barang->jumlah += $peminjaman->jumlah;
            $barang->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Pengembalian berhasil diproses',
            'data' => $peminjaman
        ]);
    }

    // 📄 Riwayat semua pengembalian (untuk admin)
   public function riwayat(Request $request)
{
    $query = Peminjaman::with(['user', 'barang'])
        ->where('status', 'dikembalikan');

    if ($request->has('tanggal_mulai') && $request->has('tanggal_selesai')) {
        $query->whereBetween('tanggal_kembali', [
            Carbon::parse($request->tanggal_mulai)->startOfDay(),
            Carbon::parse($request->tanggal_selesai)->endOfDay()
        ]);
    }

    $riwayat = $query->orderByDesc('tanggal_kembali')->get();

    $riwayat->transform(function ($item) {
        $terlambat = Carbon::parse($item->tanggal_pinjam)
            ->addDays($this->maksimalPinjam)
            ->diffInDays(Carbon::parse($item->tanggal_kembali), false);

        $item->terlambat = $terlambat > 0 ? $terlambat : 0;
        $item->denda = $item->terlambat * $this->dendaPerHari;
        return $item;
    });

    return response()->json([
        'success' => true,
        'data' => $riwayat
    ]);
}


    // 👤 Riwayat pengembalian per user
    public function riwayatUser($user_id)
    {
        $riwayat = Peminjaman::with('barang')
            ->where('user_id', $user_id)
            ->where('status', 'dikembalikan')
            ->orderByDesc('tanggal_kembali')
            ->get();

        $riwayat->transform(function ($item) {
            $terlambat = Carbon::parse($item->tanggal_pinjam)
                ->addDays($this->maksimalPinjam)
                ->diffInDays(Carbon::parse($item->tanggal_kembali), false);

            $item->terlambat = $terlambat > 0 ? $terlambat : 0;
            $item->denda = $item->terlambat * $this->dendaPerHari;
            return $item;
        });

        return response()->json([
            'success' => true,
            'data' => $riwayat
        ]);
    }
}
