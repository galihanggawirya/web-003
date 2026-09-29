@extends('layouts.main')

@section('title', 'Daftar Supplier')

@section('content')

<div style="margin-bottom: 16px">
    <a href="{{ route('item.index') }}" class="btn-tab">Item</a>
    <a href="{{ route('item.karyawan') }}" class="btn-tab">Karyawan</a>
    <a href="{{ route('item.supplier') }}" class="btn-tab active">Supplier</a>
    <a href="{{ route('item.praktikum') }}" class="btn-tab">Praktikum</a>
</div>
    
<h2>Daftar Supplier</h2>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Supplier</th>
            <th>Alamat</th>
            <th>No. Telepon</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sup as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item['nama'] }}</td>
            <td>{{ $item['alamat'] }}</td>
            <td>{{ $item['telepon'] }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align: center;">Tidak ada data supplier dalam katalog ini.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top: 20px;">
    <p><strong>Total Supplier:</strong> {{ count($sup) }}</p>
</div>

@endsection