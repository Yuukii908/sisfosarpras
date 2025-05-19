<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-small">
        
        <div class="welcome-text">
            <h2>Selamat Datang di SISFO SARPRAS</h2>
            <p>Daftarkan diri anda</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="text" name="email" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Login</button>
        </form>

        <!-- Tambahan: Link ke register -->
        <p style="margin-top: 15px;">Belum punya akun? 
            <a href="{{ route('register') }}" style="color: #e0e0e0; text-decoration: underline;">Daftar di sini</a>
        </p>
    </div>
</body>
</html>
