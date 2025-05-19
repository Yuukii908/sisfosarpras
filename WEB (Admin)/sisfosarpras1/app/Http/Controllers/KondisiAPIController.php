<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kondisi;
use Illuminate\Http\Request;

class KondisiApiController extends Controller
{
    public function index()
    {
        return Kondisi::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kondisi' => 'required|string|max:255',
        ]);

        $kondisi = Kondisi::create([
            'nama_kondisi' => $request->nama_kondisi,
        ]);

        return response()->json($kondisi, 201);
    }

    public function update(Request $request, $id)
    {
        $kondisi = Kondisi::findOrFail($id);

        $request->validate([
            'nama_kondisi' => 'required|string|max:255',
        ]);

        $kondisi->update([
            'nama_kondisi' => $request->nama_kondisi,
        ]);

        return response()->json($kondisi, 200);
    }

    public function destroy($id)
    {
        $kondisi = Kondisi::findOrFail($id);
        $kondisi->delete();

        return response()->json(null, 204);
    }
}
