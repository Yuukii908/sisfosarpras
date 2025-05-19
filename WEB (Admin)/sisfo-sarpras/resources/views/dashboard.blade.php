@extends('layouts.app')

@section('content')
<h2 class="mb-4">Dashboard</h2>
<div class="row">
    <div class="col-md-4">
        <div class="card bg-primary text-white rounded-0">
            <div class="card-body">
                Total Barang: {{ $jumlah_barang }}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white rounded-0">
            <div class="card-body">
                Peminjaman Aktif: {{ $jumlah_peminjaman }}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white rounded-0">
            <div class="card-body">
                Pengembalian Tercatat: {{ $jumlah_pengembalian }}
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-3">
        <div class="card bg-danger text-white rounded-0">
            <div class="card-body">
                Jumlah User: {{ $jumlah_user }}
            </div>
        </div>
    </div>
</div>
@endsection
