<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceType;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data device dari database
        $devices = Device::with('deviceType')->get();
        return view('devices', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Pastikan semua model di-import di bagian atas dengan 'use'
    $sites = \App\Models\Site::all();
    $roles = \App\Models\DeviceRole::all();
    $deviceTypes = \App\Models\DeviceType::all(); // Mengambil data
    
    // Kirim semua variabel ke view menggunakan compact
    return view('create_device', compact('sites', 'roles', 'deviceTypes'));
}
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'status'         => 'required|string',
            'site'           => 'required|string',
            'role'           => 'required|string',
            'device_type_id' => 'required|exists:device_types,id', // Harus ada di tabel device_types
        ]);

        // Menyimpan ke database
        Device::create($validated);

        return redirect()->route('devices.index')->with('success', 'Perangkat berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $device = Device::findOrFail($id);
        $deviceTypes = DeviceType::all();
        
        return view('devices.edit', compact('device', 'deviceTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'status'         => 'required|string',
            'site'           => 'required|string',
            'role'           => 'required|string',
            'device_type_id' => 'required|exists:device_types,id',
        ]);

        $device = Device::findOrFail($id);
        $device->update($validated);

        return redirect()->route('devices.index')->with('success', 'Data perangkat diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $device = Device::findOrFail($id);
        $device->delete();

        return redirect()->route('devices.index')->with('success', 'Perangkat dihapus!');
    }
}