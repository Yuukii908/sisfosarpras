@extends('layouts.app')

@section('content')
<h2>Data Pengembalian</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Barang</th>
            <th>Nama Pengembali</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
    @forelse($pengembalians as $kembali)
        <tr>
            <td>{{ $kembali->barang->nama }}</td>
            <td>{{ $kembali->nama_pengembali }}</td>
            <td>{{ $kembali->jumlah }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="3">Belum ada data pengembalian.</td>
        </tr>
    @endforelse
</tbody>
</table>
@endsection
