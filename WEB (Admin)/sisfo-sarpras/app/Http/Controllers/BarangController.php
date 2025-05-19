<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use Illuminate\Http\Request;

class BarangController extends Controller
{
   public function index()
{
    $barangs = Barang::with('category')->get();
    return view('barang.index', compact('barangs'));
}


    public function create() {

         $categories = Category::all();  // ambil semua kategori
    return view('barang.create', compact('categories'));
    }

    public function store(Request $request)
{
if ($request->hasFile('gambar')) {
    $gambarPath = $request->file('gambar')->store('gambar_barang', 'public');
} else {
    $gambarPath = null;
}

Barang::create([
    'nama' => $request->nama,
    'stok' => $request->stok,
    'category_id' => $request->category_id,
    'gambar' => $gambarPath,
]);


    return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
}


    public function barangMasuk(Request $request, $id) {
        $barang = Barang::findOrFail($id);
        $barang->stok += $request->jumlah;
        $barang->save();
        return redirect('/barang');
    }

    public function destroy(Barang $barang)
{
    $barang->delete();

    return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
}

    public function edit(Barang $barang)
{
    $categories = Category::all(); // untuk dropdown kategori jika perlu
    return view('barang.edit', compact('barang', 'categories'));
}


}
