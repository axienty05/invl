<?php

use App\Livewire\DropdownDependent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PemakaiController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ServiceCenterController;
use App\Http\Controllers\MutasiPerpindahanController;
use App\Http\Controllers\MutasiPembelianController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {
    Route::resource('/pemakai', PemakaiController::class)->except('show');
    Route::resource('/barang', BarangController::class)->except('show');
    Route::resource('/supplier', SupplierController::class)->except('show');
    Route::resource('/servicecenter', ServiceCenterController::class)->except('show');
    Route::resource('/service', ServiceController::class)->except('show');
    Route::resource('/mutasi/perpindahan', MutasiPerpindahanController::class)->except('edit', 'update');
    Route::resource('/mutasi/pembelian', MutasiPembelianController::class)->except('edit', 'update');
});

Route::get('/dropdowndependent', DropdownDependent::class);