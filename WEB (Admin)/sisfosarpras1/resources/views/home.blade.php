<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-small">
        
        <div class="welcome-text">
            <h2>Selamat Datang di SISFO SARPRAS</h2>
            <p>Menuju Dashboard Barang</p>

            <a href="{{ route('dashboard') }}">
                <button style="margin-top: 20px;">Masuk ke Dashboard</button>
            </a>
        </div>
    </div>
</body>
</html>
