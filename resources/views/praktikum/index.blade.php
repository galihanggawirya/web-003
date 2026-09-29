@extends('layouts.main')

@section('title', 'Praktikum 03')

@section('content')

<div style="margin-bottom: 16px">
    <a href="{{ route('item.index') }}" class="btn-tab">Item</a>
    <a href="{{ route('item.karyawan') }}" class="btn-tab">Karyawan</a>
    <a href="{{ route('item.supplier') }}" class="btn-tab">Supplier</a>
    <a href="{{ route('item.praktikum') }}" class="btn-tab active">Praktikum</a>
</div>
    
<h2>Daftar Item</h2>
<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>ID</th>
            <th>Nama Item</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Diskon</th>
            <th>Bersih</th>
        </tr>
    </thead>
    <tbody>
        @forelse($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['nama'] }}</td>
            <td>{{ $item['kategori'] }}</td>
            <td>Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
            <td>{{ $item['diskon'] }}%</td>
            <td>Rp{{ number_format($item['harga'] - ($item['harga'] * $item['diskon'] / 100), 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="text-align: center;">Tidak ada data katalog dalam katalog ini.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top: 20px;">
    <p><strong>Total Item:</strong> {{ count($items) }}</p>
</div>

@endsection