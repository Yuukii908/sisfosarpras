<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelBarang;

class ModelBarangController extends Controller
{
    public function index()
    {
        $modelBarangs = ModelBarang::all();
        return view('model_barang.index', compact('modelBarangs'));
    }

    public function create()
    {
        return view('model_barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_model' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        ModelBarang::create($request->all());
        return redirect()->route('model-barang.index')->with('success', 'Model barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $modelBarang = ModelBarang::findOrFail($id);
        return view('model_barang.edit', compact('modelBarang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_model' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $modelBarang = ModelBarang::findOrFail($id);
        $modelBarang->update($request->all());

        return redirect()->route('model-barang.index')->with('success', 'Model barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $modelBarang = ModelBarang::findOrFail($id);
        $modelBarang->delete();

        return redirect()->route('model-barang.index')->with('success', 'Model barang berhasil dihapus.');
    }
}
