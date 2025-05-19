@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">
@endpush

@section('content')
    <h2>Data Barang</h2>
    <a href="{{ url('/barang/create') }}" class="btn btn-primary mb-3">Tambah Barang</a>
   <table class="table table-bordered" id="barang-table">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($barangs as $barang)
        <tr>
            <td>{{ $barang->nama }}</td>
            <td>{{ $barang->category->nama ?? '-' }}</td>
            <td>{{ $barang->stok }}</td>
            <td>
                @if($barang->gambar)
                    <img src="{{ asset('storage/'.$barang->gambar) }}" alt="{{ $barang->nama }}" width="80">
                @else
                    <span class="text-muted">Tidak ada gambar</span>
                @endif
            </td>
            <td>
                
                 <div class="d-flex">
        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>

        <form method="POST" action="{{ route('barang.destroy', $barang->id) }}" onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
        </form>
    </div>
    </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new DataTable('#barang-table');
        });
    </script>
@endpush
