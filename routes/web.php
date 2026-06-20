<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceRoleController;
use App\Http\Controllers\DeviceTypeController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\SiteController;
// Tambahkan baris di bawah ini:
use App\Http\Controllers\IPAMController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route Dashboard yang benar dengan nama 'dashboard'
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rute Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Resource (CRUD)
    Route::resource('devices', DeviceController::class);
    Route::resource('device-roles', DeviceRoleController::class);
    Route::resource('device-types', DeviceTypeController::class);
    Route::resource('manufacturers', ManufacturerController::class);
    Route::resource('platforms', PlatformController::class);
    Route::resource('sites', SiteController::class);
    // Tambahkan baris di bawah ini:
    Route::resource('ipam', IPAMController::class);
});

require __DIR__.'/auth.php';