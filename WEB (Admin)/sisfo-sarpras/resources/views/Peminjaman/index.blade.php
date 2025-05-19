@extends('layouts.app')

@section('content')
<h2>Data Peminjaman</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Barang</th>
            <th>Nama Peminjam</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjamans as $pinjam)
        <tr>
            <td>{{ $pinjam->barang->nama }}</td>
            <td>{{ $pinjam->nama_peminjam }}</td>
            <td>{{ $pinjam->jumlah }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection