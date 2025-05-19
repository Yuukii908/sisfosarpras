@extends('layouts.app')

@section('content')
<h2>Tambah Barang</h2>
<form method="POST" action="{{ url('/barang') }}" enctype="multipart/form-data">

    @csrf

<!-- input lainnya -->
    <div class="mb-3">
        <label for="gambar" class="form-label">Upload Gambar</label>
        <input type="file" name="gambar" class="form-control">
    </div>


    <div class="mb-3">
        <label for="nama" class="form-label">Nama Barang</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

   <div class="mb-3">
    <label for="category_id" class="form-label">Kategori</label>
    <select name="category_id" class="form-control" required>
        <option value="" disabled selected>Pilih Kategori</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->nama }}</option>
        @endforeach
    </select>
</div>
    <div class="mb-3">
        <label for="stok" class="form-label">Stok Awal</label>
        <input type="number" name="stok" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
