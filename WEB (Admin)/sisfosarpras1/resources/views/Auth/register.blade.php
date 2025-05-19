<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-small">
        
        <div class="welcome-text">
            <h2>Daftar Akun SISFO SARPRAS</h2>
            <p>Silakan buat akun anda</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

            <button type="submit">Register</button>
        </form>

        <!-- Tambahan: Link ke login -->
        <p style="margin-top: 15px;">Sudah punya akun? 
            <a href="{{ route('login') }}" style="color: #e0e0e0; text-decoration: underline;">Login di sini</a>
        </p>
    </div>
</body>
</html>
