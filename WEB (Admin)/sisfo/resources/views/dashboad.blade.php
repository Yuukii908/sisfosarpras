@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Admin</h1>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Barang</h5>
                    <p class="card-text fs-4">{{ $jumlahBarang }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Dipinjam</h5>
                    <p class="card-text fs-4">{{ $jumlahDipinjam }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tersedia</h5>
                    <p class="card-text fs-4">{{ $jumlahTersedia }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pengembalian Terlambat</h5>
                    <p class="card-text fs-4">{{ $jumlahTerlambat }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
