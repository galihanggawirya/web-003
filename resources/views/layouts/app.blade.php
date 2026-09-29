<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Sistem Toko Online')</title>
</head>
<body>
    <header>
        <h1>Manajemen Toko</h1>
    </header>
    
    <main>
        <!-- Tempat konten halaman anak dirender -->
        @yield('content')
    </main>
    
    <footer>
        <p>&copy; 2026 Universitas Framework Laravel</p>
    </footer>
</body>
</html>