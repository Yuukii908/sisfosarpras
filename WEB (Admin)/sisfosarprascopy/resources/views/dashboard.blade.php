@extends('layouts.app')

@section('content')
<div class="container">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-small">
    <h1 class="text-primary">School Facilities</h1>

    <form action="{{ route('facilities.store') }}" method="POST" class="mb-4">
        @csrf
        <input type="text" name="name" placeholder="Facility Name" required class="form-control mb-2">
        <textarea name="description" placeholder="Description" class="form-control mb-2"></textarea>
        <button type="submit" class="btn btn-primary">Add Facility</button>
    </form>

    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facilities as $facility)
            <tr>
                <td>{{ $facility->name }}</td>
                <td>{{ $facility->description }}</td>
                <td>
                    <form action="{{ route('facilities.destroy', $facility) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <!-- You can add Edit modal here -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
