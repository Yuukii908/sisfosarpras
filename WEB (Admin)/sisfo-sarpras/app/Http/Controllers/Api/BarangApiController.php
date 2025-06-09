<?php 
namespace App\Http\Controllers\Api;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarangApiController extends Controller
{
    public function index()
    {
        $barang = Barang::with('category')->get();
        return response()->json(['data' => $barang])([
            'status' => true,
            'message' => 'Data Barang berhasil diambil',
            'data' => $barang->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'gambar' => $item->gambar,
                    'stok' => $item->stok, // TAMBAHKAN STOK
                    'category_id' => $item->category_id,
                    'category_nama' => $item->category->nama ?? ''
                ];
            })
        ]);
    }

    public function getBarang(){
        $barang = Barang::with('category')->get();
   return response()->json(['data'=>$barang]);
    }
}