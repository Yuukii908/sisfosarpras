<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = ['barang_id', 'nama_peminjam', 'jumlah'];

    protected $table = 'peminjamans';

    public function barang() {
        return $this->belongsTo(Barang::class);
    }
}