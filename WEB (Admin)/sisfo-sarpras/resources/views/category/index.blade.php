@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Kategori</h2>
    <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->nama }}</td>
                <td>
                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                       
                           <form action="{{ route('category.destroy', $category->id) }}" method="POST" id="delete-form-{{ $category->id }}" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

                            <button onclick="event.preventDefault(); document.getElementById('delete-form-{{ $category->id }}').submit();">
                                Hapus
                            </button>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
