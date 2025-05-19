<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangApiController extends Controller
{
    public function index()
    {
        return response()->json(Barang::with('kategori')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_barang_id' => 'required|exists:kategori_barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $barang = Barang::create($request->all());
        return response()->json($barang, 201);
    }

    public function show($id)
    {
        return response()->json(Barang::with('kategori')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        return response()->json($barang);
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return response()->json(null, 204);
    }

    public function laporanStok()
    {
        return response()->json(Barang::with('kategori')->get());
    }
}
