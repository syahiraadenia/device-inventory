<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceRole;
use App\Models\Platform;
use App\Models\Manufacturer;
use App\Models\DeviceType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data langsung dari Database PostgreSQL melalui Model
        $devices = Device::all();
        $roles = DeviceRole::all();
        $platforms = Platform::all();
        $manufacturers = Manufacturer::all();
        $types = DeviceType::all();

        // 2. Hitung jumlah data menggunakan method count() dari Eloquent
        $deviceCount = Device::count();
        $roleCount = DeviceRole::count();
        $platformCount = Platform::count();
        $manufacturerCount = Manufacturer::count();
        $typeCount = DeviceType::count();

        // 3. Data untuk Grafik Chart.js
        $chartData = [
            'labels' => ['Devices', 'Roles', 'Platforms', 'Manufacturers', 'Types'],
            'data' => [$deviceCount, $roleCount, $platformCount, $manufacturerCount, $typeCount]
        ];

        // 4. Lempar semua variabel ke view dashboard
        return view('dashboard', compact(
            'deviceCount', 
            'roleCount', 
            'platformCount', 
            'manufacturerCount', 
            'typeCount', 
            'chartData',
            'devices',
            'roles',
            'platforms',
            'manufacturers',
            'types'
        ));
    }
}