@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Edit Barang</h2>
    <form action="{{ route('barangs.update', $barang->id) }}" method="POST">
        @method('PUT')
        @include('barang.form')
    </form>
</div>
@endsection
