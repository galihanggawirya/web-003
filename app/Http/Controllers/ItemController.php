<?php

namespace App\Http\Controllers;

class ItemController extends Controller
{
    public function index() {
        $kategori = 'Elektronik & Aksesoris';
        $items = [
            ['id' => 1, 'nama' => 'Laptop Asus Vivobook', 'harga' => 8500000, 'stok' => 4, 'is_active' => true],
            ['id' => 2, 'nama' => 'Mouse Wireless Silent', 'harga' => 125000, 'stok' => 15, 'is_active' => true],
            ['id' => 3, 'nama' => 'Flashdisk 64GB USB 3.0', 'harga' => 85000, 'stok' => 0, 'is_active' => false],
        ];

        return view('item.katalog', compact('kategori', 'items'));
    }

    public function karyawan() {
        $karyawan = [
            ['id' => 1, 'nama' => 'Andi', 'jabatan' => 'Manajer', 'telepon' => '0877-1178-1192'],
            ['id' => 2, 'nama' => 'Budi', 'jabatan' => 'Supervisor', 'telepon' => '0877-1178-1193'],
            ['id' => 3, 'nama' => 'Charlie', 'jabatan' => 'Operator', 'telepon' => '0877-1178-1194'],
        ];

        return view('karyawan.index', compact('karyawan'));
    }

    public function supplier() {
        $sup = [
            ['id' => 1, 'nama' => 'Anton', 'alamat' => 'Leicestershire', 'telepon' => '0877-1178-1182'],
            ['id' => 2, 'nama' => 'Mondy', 'alamat' => 'Cheshire', 'telepon' => '0877-1178-1183'],
            ['id' => 3, 'nama' => 'James', 'alamat' => 'Salford', 'telepon' => '0877-1178-1184'],
        ];

        return view('supplier.index', compact('sup'));
    }

    public function praktikum() {
        $items = [
            ['id' => 'P01', 'nama' => 'Laptop Asus Vivobook', 'kategori' => 'Elektronik & Aksesoris', 'harga' => 8500000, 'diskon' => 5],
            ['id' => 'P02', 'nama' => 'Mouse Wireless Silent', 'kategori' => 'Elektronik & Aksesoris', 'harga' => 125000, 'diskon' => 10],
            ['id' => 'P03', 'nama' => 'Flashdisk 64GB USB 3.0', 'kategori' => 'Elektronik & Aksesoris', 'harga' => 85000, 'diskon' => 10],
            ['id' => 'P04', 'nama' => 'Indomie Tori Miso', 'kategori' => 'Makanan', 'harga' => 5500, 'diskon' => 5],
            ['id' => 'P05', 'nama' => 'Lotte Chocopie 12 pcs', 'kategori' => 'Makanan', 'harga' => 22500, 'diskon' => 5],
        ];

        return view('praktikum.index', compact('items'));
    }
}
