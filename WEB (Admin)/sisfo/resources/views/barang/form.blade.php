@csrf
<div class="mb-3">
    <label>Nama Barang</label>
    <input type="text" name="nama" value="{{ old('nama', $barang->nama ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label>Kategori</label>
    <input type="text" name="kategori" value="{{ old('kategori', $barang->kategori ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label>Stok</label>
    <input type="number" name="stok" value="{{ old('stok', $barang->stok ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $barang->deskripsi ?? '') }}</textarea>
</div>
<button type="submit" class="btn btn-success">Simpan</button>
