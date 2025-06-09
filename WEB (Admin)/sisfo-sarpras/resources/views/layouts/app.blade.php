<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sisfo Sarpras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @stack('styles')

    <style>
        body {
            background-color: #f0f8ff;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .nav-link, .footer {
            color: #fff !important;
        }
        .card {
            border-radius: 10px;
        }

        /* Sidebar styles */
        #sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            position: fixed;
            top: 0;
            left: -250px;
            transition: left 0.3s ease;
            padding-top: 60px;
            z-index: 1000;
        }

        #sidebar.active {
            left: 0;
        }

        #sidebar ul {
            list-style: none;
            padding: 0;
        }

        #sidebar ul li a {
            color: white;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }

        #sidebar ul li a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 0;
            transition: margin-left 0.3s ease;
        }

        .content.shifted {
            margin-left: 250px;
        }
    </style>
</head>
@stack('scripts')



<body>
    @if(session('success'))
        <div style="color: green; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    

   <!-- Sidebar -->
<div id="sidebar">
    <ul>
        <li><a href="/dashboard">Dashboard</a></li>
        <li><a href="/barang">Data Barang</a></li>
        <li><a href="/peminjaman">Peminjaman</a></li>
        <li><a href="/pengembalian">Pengembalian</a></li>
        <li><a href="/categories/index">Category</a></li>
        <li><a href="/register">Register user</a></li>
    </ul>

    @auth
    <form method="POST" action="{{ route('logout') }}" style="position: absolute; bottom: 20px; width: 100%; text-align: center;">
        @csrf
        <button type="submit" class="btn btn-danger w-75">Logout</button>
    </form>
    @endauth
</div>

    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <button class="btn btn-light me-2" id="toggleSidebar">☰</button>
        <a class="navbar-brand" href="/dashboard">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="40" class="me-2">
            Sisfo Sarpras
            </a>
            @auth
            @endauth
        </div>
    </nav>

    <!-- Main content -->
    <div class="content container py-4 mt-5">
        @yield('content')
    </div>

    <!-- Script -->
    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const content = document.querySelector('.content');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            content.classList.toggle('shifted');
        });
    </script>
</body>
</html>
