<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Sarpras</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .navbar {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: left;
            width:50px;
            
        }
        .sidebar {
            background: #007bff;
            color: white;
            width: 200px;
            padding: 15px;
            height: 100vh;
            position: fixed;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background: #0056b3;
        }
        .container {
            margin-left: 220px; /* Space for sidebar */
            padding: 20px;
            width: calc(100% - 220px);
        }
        .card {
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            padding: 20px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: white;
            position: fixed;
            bottom: 0;
            width: calc(100% - 220px);
            margin-left: 220px; /* Space for sidebar */
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>Dashboard Sarpras</h1>
    </div>

    <div class="sidebar">
        <h3>Menu</h3>
        <a href="#">Pendataan Kategori Barang</a>
        <a href="#">Pendataan Barang</a>
        <a href="#">Pendataan Peminjaman</a>
        <a href="#">Pendataan Pengembalian</a>
        <a href="#">Laporan Stok Barang</a>
        <a href="#">Laporan Peminjaman</a>
        <a href="#">Laporan Pengembalian</a>
    </div>

    <div class="container">
        <div class="card">
            <h2>Selamat Datang di Dashboard Sarpras</h2>
        </div>
        
        <div class="card">
            <h3>Statistik Sarpras</h3>
            <p>Jumlah Sarana: 100</p>
            <p>Jumlah Prasarana: 50</p>
            <p>Jumlah Pengguna: 200</p>
        </div>
    </div>

</body>
</html>