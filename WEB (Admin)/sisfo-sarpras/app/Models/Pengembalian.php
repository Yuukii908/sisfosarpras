<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $fillable = ['barang_id', 'nama_pengembali', 'jumlah'];


public function barang()
{
    return $this->belongsTo(Barang::class);
}

}