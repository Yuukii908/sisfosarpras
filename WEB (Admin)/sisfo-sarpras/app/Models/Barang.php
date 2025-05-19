<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
  protected $fillable = ['nama', 'stok', 'category_id', 'gambar'];

public function category()
{
    return $this->belongsTo(Category::class);
}

}
