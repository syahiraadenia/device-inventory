<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceType;
use App\Models\DeviceRole;
use App\Models\Site;
use App\Models\Platform;
use App\Models\Manufacturer; 
use App\Models\IPAM; // Menggunakan kapital sesuai nama class di IPAM.php
use Illuminate\Http\Request;
use Illuminate\Support\Arr; // Tambahkan ini untuk memisahkan array data IP

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        $query = Device::with(['deviceRole', 'site', 'manufacturer', 'platform']);

        // Filter departemen
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        // Pencarian nama perangkat
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
        }

        $devices = $query->latest()->get();
        
        return view('devices', compact('devices'));
    }

    public function create()
    {
        $sites = Site::all();
        $roles = DeviceRole::all();
        $deviceTypes = DeviceType::all();
        $manufacturers = Manufacturer::all(); 
        $platforms = Platform::all();
        
        return view('create_device', compact('sites', 'roles', 'deviceTypes', 'manufacturers', 'platforms'));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'device_role_id' => 'required|exists:device_roles,id',
            'department'     => 'required|string',
            'status'         => 'required|string',
            'device_type_id' => 'required|exists:device_types,id',
            'site_id'        => 'required|exists:sites,id',
            'platform_id'    => 'required|exists:platforms,id',
            'owner_name'     => 'nullable|string',
            'manufacturer_id'=> 'required|exists:manufacturers,id', 
            'serial_number'  => 'nullable|string',
            'purchase_date'  => 'nullable|date',
            // Validasi IPAM
            'ip_address'     => 'nullable|ip|unique:ipam,ip_address',
            'gateway'        => 'nullable|ip',
        ]);

        // 2. Pisahkan data IP agar tidak masuk ke tabel devices, lalu simpan Device
        $deviceData = Arr::except($validated, ['ip_address', 'gateway']);
        $device = Device::create($deviceData);

        // 3. Simpan IPAM jika ada input IP Address
        if ($request->filled('ip_address')) {
            IPAM::create([
                'device_id'  => $device->id,
                'ip_address' => $request->ip_address,
                'gateway'    => $request->gateway,
            ]);
        }

        return redirect()->route('devices.index')->with('success', 'Perangkat dan IP berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $device = Device::findOrFail($id);
        $sites = Site::all();
        $roles = DeviceRole::all();
        $deviceTypes = DeviceType::all();
        $manufacturers = Manufacturer::all(); 
        $platforms = Platform::all();
        
        return view('edit_device', compact('device', 'sites', 'roles', 'deviceTypes', 'manufacturers', 'platforms'));
    }

    public function update(Request $request, string $id)
    {
        $device = Device::findOrFail($id);

        // 1. Validasi
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'status'         => 'required|string',
            'site_id'        => 'required|exists:sites,id',
            'device_role_id' => 'required|exists:device_roles,id',
            'device_type_id' => 'required|exists:device_types,id',
            'owner_name'     => 'nullable|string',
            'department'     => 'nullable|string',
            'serial_number'  => 'nullable|string',
            'purchase_date'  => 'nullable|date',
            'platform_id'    => 'required|exists:platforms,id',
            'manufacturer_id'=> 'required|exists:manufacturers,id', // Disamakan dengan store agar tidak error
            // Validasi IPAM (Pengecualian unique jika IP tidak diubah)
            'ip_address'     => 'nullable|ip', 
            'gateway'        => 'nullable|ip',
        ]);

        // 2. Update Device (Kecualikan IP)
        $deviceData = Arr::except($validated, ['ip_address', 'gateway']);
        $device->update($deviceData);

        // 3. Update atau Simpan IPAM
        if ($request->filled('ip_address')) {
            IPAM::updateOrCreate(
                ['device_id' => $device->id],
                [
                    'ip_address' => $request->ip_address,
                    'gateway'    => $request->gateway,
                ]
            );
        }

        return redirect()->route('devices.index')->with('success', 'Data perangkat dan IP diperbarui!');
    }

    public function destroy(string $id)
    {
        $device = Device::findOrFail($id);
        $device->delete(); // Karena di migration IPAM pakai onDelete('cascade'), IP-nya otomatis ikut terhapus

        return redirect()->route('devices.index')->with('success', 'Perangkat dihapus!');
    }
}