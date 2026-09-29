# PERTEMUAN 3 KONSEP VIEW LARAVEL BLADE TEMPLATING ENGINE DI LARAVEL

## I. TUJUAN PEMBELAJARAN

Setelah menyelesaikan materi kuliah ini, mahasiswa diharapkan mampu:

1. Memahami konsep, mekanisme kerja, dan keunggulan Blade Templating Engine pada Laravel.
2. Menggunakan sintaks penulisan data Blade untuk menampilkan output secara aman (escaping).
3. Menerapkan struktur kontrol logika Blade (pengkondisian, perulangan, dan variabel `$loop`).
4. Membangun struktur tata letak modular menggunakan teknik Layout Inheritance, Include Partials, dan Blade Components.
5. Memanfaatkan Utility Directives bawaan Laravel untuk penanganan form, autentikasi, dan manipulasi kelas HTML.

## II. MATERI DASAR BLADE TEMPLATING ENGINE

### 1. Definisi dan Cara Kerja

Blade adalah templating engine bawaan Laravel yang memungkinkan pembuat kode menulis gabungan sintaks PHP murni dengan HTML secara bersih. Berkas Blade disimpan dalam direktori `resources/views/` dengan ekstensi `.blade.php`.

Mekanisme kerja Blade:

- Kompilasi ke PHP Murni: Semua sintaks Blade (dimulai dengan karakter `@` atau `{{ }}`) akan dikompilasi menjadi kode PHP murni oleh Laravel.
- Sistem Caching: Hasil kompilasi disimpan di direktori `storage/framework/views/`. Laravel hanya akan mengompilasi ulang berkas Blade jika terjadi perubahan pada file aslinya, sehingga performance aplikasi tetap cepat.


### 2. Sintaks Menampilkan Data (Output Data)

| Sintaks | Kode Terkompilasi | PHP Fungsi & Kegunaan | 
| ------ | ------ | ------ |
| `{{ $data }}` | `<?php echo e($data); ?>` | Escaped Output: Mengubah karakter khusus HTML (seperti `<script>`) menjadi entitas HTML aman menggunakan `htmlspecialchars()`. Mencegah serangan Cross-Site Scripting (XSS). |
| `{!! $data !!}` |  `<?php echo $data; ?>` | Unescaped Output: Menampilkan string HTML murni tanpa escaping Digunakan jika variabel memang berisi format HTML (misal dari WYSIWYG Editor ).

## III. STRUKTUR KONTROL BLADE

### 1. Pengkondisian (Conditionals)

#### A. Directives `@if`, `@elseif`, `@else`

```
@if($stok > 10)

<span class="badge success">Stok Melimpah</span>

@elseif($stok > 0)

<span class="badge warning">Stok Penjualan Menipis</span>

@else

<span class="badge danger">Stok Habis</span>

@endif
```

#### B. Directives Spesifik (`@unless`, `@isset`, `@empty`)

- **@unless** : Kebalikan dari @if (berjalan jika kondisi false).
- **@isset** : Memeriksa apakah variabel terdefinisi dan tidak null.
- **@empty** : Memeriksa apakah variabel kosong (null, [], "", dll).


```
@unless($isLunas)

<p class="alert">Tagihan pembayaran belum dilunasi!</p>

@endunless

@isset($diskon)

<p>Diskon: {{ $diskon }}%</p>

@endisset

@empty($items)

<p>Tidak ada item dalam keranjang belanja.</p>

@empty
```

#### C. Directive `@switch`

```
@switch($statusOtorisasi)

@case('admin')

<p>Akses Penuh Sistem</p>

@break

@case('kasir')

<p>Akses Transaksi Penjualan</p>

@break

@default

<p>Akses Pelanggan</p>

@endswitch
```

### 2. Perulangan (Loops) & Variabel `$loop`

#### A. `@foreach` dan `@forelse`

Directives `@forelse` sangat berguna untuk menangani array yang berpotensi kosong tanpa
perlu menambahkan blok `@if`.

```
<!-- Menggunakan @forelse -->

<ul>

@forelse($daftarItem as $item)


<li>{{ $item['nama'] }} - Rp {{ number_format($item['harga']) }}</li>

@empty

<li class="text-muted">Belum ada item yang terdaftar.</li>

@endforelse

</ul>
```

#### B. Variabel Spesifik `$loop`

Di dalam perulangan `@foreach` atau `@forelse`, Blade menyediakan variabel otomatis `$loop`
yang menyimpan informasi konteks perulangan:

```
@foreach($items as $item)

<div class="{{ $loop->first? 'highlight-first' : '' }}">

<p>Iterasi Ke: {{ $loop->iteration }} dari {{ $loop->count }}</p>

<p>Item: {{ $item['nama'] }}</p>

</div>

@endforeach
```

## IV. MODULARISASI VIEW & LAYOUTING

Blade menyediakan dua pendekatan arsitektur tampilan modern: **Inheritance Layout** dan **Blade
Components**.

### 1. Template Inheritance (@extends, @yield, @section)

#### A. Master Layout (`resources/views/layouts/app.blade.php`)

```
<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

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
```

#### B. Child View (`resources/views/item/index.blade.php`)

```
@extends('layouts.app')

@section('title', 'Katalog Item Penjualan')

@section('content')

<h2>Daftar Item Penjualan</h2>

<p>Selamat datang di modul katalog item.</p>

@endsection
```

### 2. Sub-Views / Partials (@include)

Memecah komponen UI berulang (seperti navbar, sidebar, alert) ke berkas terpisah.

```
<!-- Memanggil partial view navbar -->

@include('partials.navbar')

<!-- Pass data opsional ke partial view -->


@include('partials.alert', ['type' => 'success', 'message' => 'Data item berhasil disimpan!'])
```

### 3. Blade Components (<x-component>)

Fitur modern Laravel berbasis class atau anonymous component untuk encapsulasi UI reusabel.

#### A. Membuat Anonymous Component

#### (`resources/views/components/card.blade.php`)

```
@props(['title', 'type' => 'info'])

<div class="card card-{{ $type }}">

<div class="card-header">

<h3>{{ $title }}</h3>

</div>

<div class="card-body">

{{ $slot }}

</div>

</div>
```

#### B. Menggunakan Component di View

```
<x-card title="Informasi Stok Item" type="warning">

<p>Peringatan: Ada 3 item yang stoknya kurang dari 5 unit!</p>

</x-card>
```

## V. DIRECTIVES KHUSUS & UTILITIES

### 1. Form & CSRF Directives

```
<form action="/item/store" method="POST">

<!-- Generates hidden CSRF token input field -->

@csrf

<!-- Method Spoofing untuk PUT/PATCH/DELETE -->


@method('PUT')

<input type="text" name="nama_item">

<!-- Menampilkan pesan error validasi -->

@error('nama_item')

<div class="error">{{ $message }}</div>

@enderror

<button type="submit">Simpan</button>

</form>
```

### 2. Directives Autentikasi

```
@auth

<p>Selamat datang kembali, {{ auth()->user()->name }}!</p>

@endauth

@guest

<a href="/login">Silakan Login</a>

@endguest
```

### 3. Utility Directives (@class, @json, @php)

```
<!-- Dynamic CSS Classes -->

<div @class([

'item-card',

'bg-success' => $item['is_active'],

'border-danger' => $item['stok'] == 0,

])>

</div>

<!-- Mengoper Array/Data PHP langsung ke JavaScript -->

<script>


const itemsData = @json($items);

</script>

<!-- Blok PHP Murni (Digunakan Seperlunya) -->

@php

$totalNilaiStok = array_reduce($items, function($carry, $item) {

return $carry + ($item['harga'] * $item['stok']);

}, 0);

@endphp
```

## VI. CONTOH IMPLEMENTASI STUDI KASUS: MODUL KATALOG ITEM

### 1. Controller (`app/Http/Controllers/ItemController.php`)

```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller

{

public function index()

{

$kategori = "Elektronik & Aksesoris";

$items = [

['id' => 1, 'nama' => 'Laptop Asus Vivobook', 'harga' => 8500000, 'stok' => 4, 'is_active' =>
true],

['id' => 2, 'nama' => 'Mouse Wireless Silent', 'harga' => 125000, 'stok' => 15, 'is_active' =>
true],


['id' => 3, 'nama' => 'Flashdisk 64GB USB 3.0', 'harga' => 85000, 'stok' => 0, 'is_active' =>
false],

];

return view('item.katalog', compact('kategori', 'items'));

}

}
```

### 2. View Component Alert

### (`resources/views/components/alert.blade.php`)

```
@props(['type' => 'info'])

<div style="padding: 12px; margin-bottom: 15px; border-radius: 4px;

background-color: {{ $type === 'warning'? '#fff3cd' : '#d1e7dd' }};

color: {{ $type === 'warning'? '#664d03' : '#0f5132' }};">

{{ $slot }}

</div>
```

### 3. Master Layout (`resources/views/layouts/main.blade.php`)

```
<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<title>@yield('title') - Toko Kita</title>

<style>

body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f6f9; }

.container { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px
rgba(0,0,0,0.1); }

table { width: 100%; border-collapse: collapse; margin-top: 15px; }

th, td { border: 1px solid #dee2e6; padding: 10px; text-align: left; }

th { background-color: #343a40; color: white; }

.text-danger { color: #dc3545; font-weight: bold; }


.badge-success { background: #198754; color: white; padding: 3px 8px; border-radius: 3px; }

.badge-secondary { background: #6c757d; color: white; padding: 3px 8px; border-radius:
3px; }

</style>

</head>

<body>

<div class="container">

@yield('content')

</div>

</body>

</html>
```

### 4. View Utama Katalog (`resources/views/item/katalog.blade.php`)

```
@extends('layouts.main')

@section('title', 'Katalog Item Penjualan')

@section('content')

<h2>Katalog Item: {{ $kategori }}</h2>

<x-alert type="warning">

<strong>Perhatian!</strong> Harap periksa ketersediaan stok sebelum memproses
pesanan.

</x-alert>

<table>

<thead>

<tr>

<th>No</th>

<th>Nama Item</th>

<th>Harga</th>


<th>Stok</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@forelse($items as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item['nama'] }}</td>

<td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>

<td>

@if($item['stok'] == 0)

<span class="text-danger">Habis</span>

@else

{{ $item['stok'] }} unit

@endif

</td>

<td>

<span class="{{ $item['is_active']? 'badge-success' : 'badge-secondary' }}">

{{ $item['is_active']? 'Aktif' : 'Non-Aktif' }}

</span>

</td>

</tr>

@empty

<tr>

<td colspan="5" style="text-align: center;">Tidak ada data item dalam katalog
ini.</td>

</tr>

@endforelse

</tbody>

</table>

<div style="margin-top: 20px;">


<p><strong>Total Jenis Item:</strong> {{ count($items) }}</p>

</div>

@endsection
```

## VII. RANGKUMAN & LATIHAN PRAKTIKUM

### Rangkuman

- **Blade** menyederhanakan sintaks tampilan dengan mengompilasi kode Blade menjadi
    PHP murni berkinerja tinggi.
- Penggunaan {{ }} secara otomatis menyaring input dari ancaman serangan **XSS**.
- Modularisasi antarmuka dapat dibangun secara terstruktur menggunakan kombinasi
    **Master Layout (@extends)** , **Sub-View (@include)** , dan **Blade Components (<x-**
    **component>)**.

### Latihan (Tugas Mandiri)

1. **Tugas 1:** Buatlah sebuah Blade Component bernama card-item yang menerima
    parameter namaItem, harga, dan stok untuk menampilkan item berupa tampilan
    _grid/card_ produk.
2. **Tugas 2:** Buat halaman rekap transaksi penjualan item yang menggunakan directive
    `@forelse` dan memanfaatkan variabel `$loop->even` serta `$loop->odd` untuk memberikan
    warna belang-seling pada baris tabel HTML.
