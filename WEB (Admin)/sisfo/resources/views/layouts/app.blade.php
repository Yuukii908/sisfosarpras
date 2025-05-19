<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sisfo Sarpras Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        @include('layouts.sidebar')

        <main class="flex-grow-1 p-4 bg-light" style="min-height: 100vh;">
            @yield('content')
        </main>
    </div>
</body>
</html>
