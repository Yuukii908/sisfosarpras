@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Tambah Barang</h2>
    <form action="{{ route('barangs.store') }}" method="POST">
        @include('barang.form')
    </form>
</div>
@endsection
