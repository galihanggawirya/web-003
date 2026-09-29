<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Toko Kita</title>
    <style>
    body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f6f9; }
    
    .container { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    
    table { width: 100%; border-collapse: collapse; margin-top: 15px; }

    th, td { border: 1px solid #dee2e6; padding: 10px; text-align: left; }

    th { background-color: #343a40; color: white; }

    .text-danger { color: #dc3545; font-weight: bold; }

    .badge-success { background: #198754; color: white; padding: 3px 8px; border-radius: 3px; }

    .badge-secondary { background: #6c757d; color: white; padding: 3px 8px; border-radius: 3px; }

    .btn-tab { padding: 5px 12px; border: 1px solid #ccc; background: #e9ecef; cursor: pointer; text-decoration: none; color: black; font-size: 14px; margin-right: 4px; }
    
    .btn-tab.active { background: #fff; font-weight: bold; border-bottom: 1px solid white; }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>