<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/item', [ItemController::class, 'index'])->name('item.index');
Route::get('/karyawan', [ItemController::class, 'karyawan'])->name('item.karyawan');
Route::get('/supplier', [ItemController::class, 'supplier'])->name('item.supplier');
Route::get('/praktikum', [ItemController::class, 'praktikum'])->name('item.praktikum');