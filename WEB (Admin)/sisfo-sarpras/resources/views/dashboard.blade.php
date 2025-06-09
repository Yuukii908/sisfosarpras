@extends('layouts.app')

@section('content')
<h2 class="mb-4">Dashboard</h2>
<div class="row g-3">
    <!-- Total Barang -->
    <div class="col-md-3">
        <div class="card text-white bg-primary h-100 shadow-sm">
            <div class="card-body d-flex flex-column justify-content-center">
                <h5 class="card-title"><i class="fas fa-box"></i> Barang Tersedia</h5>
                <p class="card-text fs-4">{{ $jumlah_barang }}</p>
            </div>
        </div>
    </div>

    <!-- Barang Dipinjam -->
    <div class="col-md-3">
        <div class="card text-white bg-info h-100 shadow-sm">
            <div class="card-body d-flex flex-column justify-content-center">
                <h5 class="card-title"><i class="fas fa-hand-holding"></i> Barang Dipinjam</h5>
                <p class="card-text fs-4">{{ $jumlah_barang_dipinjam }}</p>
            </div>
        </div>
    </div>

    <!-- Barang Dikembalikan -->
    <div class="col-md-3">
        <div class="card text-white bg-success h-100 shadow-sm">
            <div class="card-body d-flex flex-column justify-content-center">
                <h5 class="card-title"><i class="fas fa-undo"></i> Barang Dikembalikan</h5>
                <p class="card-text fs-4">{{ $jumlah_barang_dikembalikan }}</p>
            </div>
        </div>
    </div>

    <!-- User Online -->
    <div class="col-md-3">
        <div class="card text-white bg-warning h-100 shadow-sm">
            <div class="card-body d-flex flex-column justify-content-center">
                <h5 class="card-title"><i class="fas fa-user-check"></i> User Online</h5>
                <p class="card-text fs-4">{{ $jumlah_user_online }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
