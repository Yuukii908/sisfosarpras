<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = ['user_id', 'barang_id', 'jumlah', 'tanggal_pinjam', 'status'];

    public function barang() {
        return $this->belongsTo(Barang::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
