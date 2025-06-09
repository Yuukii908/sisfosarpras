@extends('layouts.app')

@section('content')
<h2>Data Peminjaman</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Gambar Barang</th>
            <th>Barang</th>
            <th>Kategori</th>
            <th>Nama Peminjam</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjamans as $pinjam)
        <tr>
            <td>
                @if($pinjam->barang->gambar)
                    <img src="{{ asset('storage/' . $pinjam->barang->gambar) }}" alt="{{ $pinjam->barang->nama }}" style="width: 100px; height: auto;">
                @else
                    <span>Tidak ada gambar</span>
                @endif
            </td>
            <td>{{ $pinjam->barang->nama }}</td>
            <td>{{ $pinjam->barang->kategori->nama ?? '-' }}</td>  {{-- tambah ini --}}
            <td>{{ $pinjam->nama_peminjam }}</td>
            <td>{{ $pinjam->jumlah }}</td>
            <td>
                @if($pinjam->status == 'dikembalikan')
                    <span class="badge bg-success">Dikembalikan</span>
                @else
                    <span class="badge bg-warning text-dark">Dipinjam</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
