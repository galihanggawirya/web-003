@extends('layouts.main')

@section('title', 'Katalog Item Penjualan')

@section('content')

<div style="margin-bottom: 16px">
    <a href="{{ route('item.index') }}" class="btn-tab active">Item</a>
    <a href="{{ route('item.karyawan') }}" class="btn-tab">Karyawan</a>
    <a href="{{ route('item.supplier') }}" class="btn-tab">Supplier</a>
    <a href="{{ route('item.praktikum') }}" class="btn-tab">Praktikum</a>
</div>
<h2>Katalog Item: {{ $kategori }}</h2>

<x-alert type="warning">
    <strong>Perhatian!</strong> Harap periksa ketersediaan stok sebelum memproses pesanan.
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
                <span class="{{ $item['is_active'] ? 'badge-success' : 'badge-secondary' }}">
                    {{ $item['is_active'] ? 'Aktif' : 'Non-Aktif' }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align: center;">Tidak ada data item dalam katalog ini.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top: 20px;">
    <p><strong>Total Jenis Item:</strong> {{ count($items) }}</p>
</div>

@endsection
