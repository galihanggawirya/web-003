@extends('layouts.main')

@section('title', 'Daftar Karyawan')

@section('content')

<div style="margin-bottom: 16px">
    <a href="{{ route('item.index') }}" class="btn-tab">Item</a>
    <a href="{{ route('item.karyawan') }}" class="btn-tab active">Karyawan</a>
    <a href="{{ route('item.supplier') }}" class="btn-tab">Supplier</a>
    <a href="{{ route('item.praktikum') }}" class="btn-tab">Praktikum</a>
</div>
    
<h2>Daftar Karyawan</h2>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Jabatan</th>
            <th>No. Telepon</th>
        </tr>
    </thead>
    <tbody>
        @forelse($karyawan as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item['nama'] }}</td>
            <td>{{ $item['jabatan'] }}</td>
            <td>{{ $item['telepon'] }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align: center;">Tidak ada data karyawan dalam katalog ini.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top: 20px;">
    <p><strong>Total Karyawan:</strong> {{ count($karyawan) }}</p>
</div>

@endsection