<?php

// Barang.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['kategori_barang_id', 'nama', 'stok'];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class);
    }
}