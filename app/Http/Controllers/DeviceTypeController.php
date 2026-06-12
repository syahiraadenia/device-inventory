<?php

namespace App\Http\Controllers;

use App\Models\DeviceType;
use App\Models\Manufacturer;
use App\Models\Platform; // Pastikan model ini ada
use Illuminate\Http\Request;

class DeviceTypeController extends Controller
{
    public function index()
{
    // Menggunakan relasi tunggal 'platform'
    $device_types = DeviceType::with(['manufacturer', 'platform'])->get();
    return view('device_types', compact('device_types'));
}

    public function create()
{
    $manufacturers = Manufacturer::all();
    $platforms = Platform::all();

    // Debugging: Cek apakah variabel terisi atau kosong (null)
    // dd($manufacturers, $platforms); 

    return view('create_device_type', compact('manufacturers', 'platforms'));
}

    public function store(Request $request)
{
    // 1. Validasi
    $validated = $request->validate([
        'manufacturer_id'  => 'required|exists:manufacturers,id',
        'default_platform' => 'nullable|exists:platforms,id', // Harus sama dgn name di form
        'model'            => 'required|string|max:255',
        'slug'             => 'required|string|max:255|unique:device_types,slug',
        'height'           => 'required|numeric',
        'description'      => 'nullable|string',
    ]);

    // 2. Simpan ke Database
    DeviceType::create([
        'manufacturer_id' => $validated['manufacturer_id'],
        'platform_id'     => $validated['default_platform'] ?? null, // Map ke field DB
        'model_name'      => $validated['model'],
        'slug'            => $validated['slug'],
        'height'          => $validated['height'],
        'description'     => $validated['description'],
    ]);

    return redirect()->route('device-types.index')->with('success', 'Device Type berhasil ditambahkan!');
}

    public function edit(string $id)
    {
        $device_type = DeviceType::findOrFail($id);
        $manufacturers = Manufacturer::all();
        $platforms = Platform::all(); // Tambahkan untuk edit
        return view('edit_device_type', compact('device_type', 'manufacturers', 'platforms'));
    }

    public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'manufacturer_id' => 'required|exists:manufacturers,id',
        'default_platform'=> 'nullable|exists:platforms,id', // Harus sama dengan name di form edit
        'model'           => 'required|string|max:255',
        'slug'            => 'required|string|max:255',
        'height'          => 'required|numeric',
        'description'     => 'nullable|string',
    ]);

    $device_type = DeviceType::findOrFail($id);
    
    $device_type->update([
        'manufacturer_id' => $validated['manufacturer_id'],
        'platform_id'     => $validated['default_platform'] ?? null, // Mengambil data dari validated
        'model_name'      => $validated['model'],
        'slug'            => $validated['slug'],
        'height'          => $validated['height'],
        'description'     => $validated['description'],
    ]);

    return redirect()->route('device-types.index')->with('success', 'Device Type berhasil diperbarui!');
}
    
    // ... method destroy tetap sama ...
}