<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceType;
use App\Models\DeviceRole;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Tambahkan 'deviceRole' dan 'site' ke dalam array with()
    $devices = Device::with(['deviceRole', 'deviceType', 'site'])->get();
    return view('devices', compact('devices'));
}

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    // Mengambil semua data agar dropdown terisi
    $sites = \App\Models\Site::all();
    $roles = \App\Models\DeviceRole::all();
    $deviceTypes = \App\Models\DeviceType::all();
    
    // Pastikan semua variabel ini dikirim menggunakan compact
    return view('create_device', compact('sites', 'roles', 'deviceTypes'));
}
   public function store(Request $request)
{
    // 1. Validasi harus mencakup semua field yang ada di form
    $validated = $request->validate([
        'name'           => 'required|string|max:255',
        'device_role_id' => 'required|exists:device_roles,id',
        'department'     => 'required|string',
        'status'         => 'required|string',
        'device_type_id' => 'required|exists:device_types,id',
        'site_id'        => 'required|exists:sites,id',
        'owner_name'     => 'nullable|string',
        'manufacturer'   => 'nullable|string',
        'serial_number'  => 'nullable|string',
        'purchase_date'  => 'nullable|date',
    ]);

    // 2. Simpan ke database
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
        
        return view('edit_device', compact('device', 'deviceTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'name'           => 'required|string|max:255',
        'status'         => 'required|string',
        'site_id'        => 'required|exists:sites,id',
        'device_role_id' => 'required|exists:device_roles,id',
        'device_type_id' => 'required|exists:device_types,id',
        // Tambahkan field ini agar bisa diedit:
        'owner_name'     => 'nullable|string',
        'department'     => 'nullable|string',
        'manufacturer'   => 'nullable|string',
        'serial_number'  => 'nullable|string',
        'purchase_date'  => 'nullable|date',
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