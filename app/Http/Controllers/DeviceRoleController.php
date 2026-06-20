<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceRole; 
use Illuminate\Http\Request;

class DeviceRoleController extends Controller
{
   public function index(Request $request)
{
    $query = DeviceRole::query();

    if ($request->filled('search')) {
        $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($request->search) . '%']);
    }

    $roles = $query->get()->each(function ($role) {
        // Hitung manual dengan mencocokkan Nama Role dan Departemen
        $role->devices_count = Device::where('department', $role->department)
                                     ->whereHas('deviceRole', function($q) use ($role) {
                                         $q->where('name', $role->name);
                                     })->count();
    });

    return view('device_roles', compact('roles'));
}
    public function create()
    {
        return view('create_device_role');
    }

    public function store(Request $request)
    {
        // Validasi disesuaikan dengan field yang ada di form
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'department'  => 'required|string|max:255', // Ganti slug jadi department
            'description' => 'nullable|string',        // Tambahkan description
        ]);

        DeviceRole::create($validated);
        
        return redirect()->route('device-roles.index')->with('success', 'Role berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $role = DeviceRole::findOrFail($id);
        return view('edit_device_role', compact('role'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'department'  => 'required|string|max:255', // Ganti slug jadi department
            'description' => 'nullable|string',
        ]);

        $role = DeviceRole::findOrFail($id);
        $role->update($validated);
        
        return redirect()->route('device-roles.index')->with('success', 'Role berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $role = DeviceRole::findOrFail($id);
        $role->delete();
        
        return redirect()->route('device-roles.index')->with('success', 'Role berhasil dihapus!');
    }
}