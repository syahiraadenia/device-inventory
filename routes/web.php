<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceRoleController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\DeviceTypeController;
use App\Http\Controllers\SiteController; // Pastikan ini sudah di-import

// Rute Halaman Utama Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index']);

// Group Route Inventaris NetBox
Route::resource('devices', DeviceController::class);
Route::resource('device-roles', DeviceRoleController::class);
Route::resource('platforms', PlatformController::class);
Route::resource('manufacturers', ManufacturerController::class);
Route::resource('device-types', DeviceTypeController::class);
Route::resource('sites', SiteController::class); // TAMBAHKAN BARIS INI

// Rute Tambahan untuk Pembersihan Data
Route::get('/reset-data', function () {
    session()->flush(); 
    return redirect()->route('dashboard')->with('success', 'Sistem berhasil dibersihkan.');
});