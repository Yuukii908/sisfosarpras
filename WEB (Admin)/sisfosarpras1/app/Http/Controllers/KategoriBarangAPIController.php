<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangApiController extends Controller
{
    public function index()
    {
        return response()->json(KategoriBarang::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = KategoriBarang::create($request->all());
        return response()->json($kategori, 201);
    }

    public function show($id)
    {
        return response()->json(KategoriBarang::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriBarang::findOrFail($id);
        $kategori->update($request->all());
        return response()->json($kategori);
    }

    public function destroy($id)
    {
        KategoriBarang::destroy($id);
        return response()->json(null, 204);
    }
}
