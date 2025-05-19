<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PengembalianApiController extends Controller
{
    public function index()
    {
        return response()->json(Pengembalian::with('peminjaman')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamen,id',
            'tanggal_pengembalian' => 'required|date',
        ]);

        $pengembalian = Pengembalian::create($request->all());

        // Update status Peminjaman menjadi 'dikembalikan'
        $peminjaman = Peminjaman::find($request->peminjaman_id);
        $peminjaman->update(['status' => 'dikembalikan']);

        return response()->json($pengembalian, 201);
    }

    public function show($id)
    {
        return response()->json(Pengembalian::with('peminjaman')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->update($request->all());
        return response()->json($pengembalian);
    }

    public function destroy($id)
    {
        Pengembalian::destroy($id);
        return response()->json(null, 204);
    }

    public function laporanPengembalian()
    {
        return response()->json(Pengembalian::with('peminjaman')->get());
    }
}
