<?php

namespace App\Http\Controllers;

use App\Models\DeviceRole; 
use Illuminate\Http\Request;

class DeviceRoleController extends Controller
{
    public function index()
    {
        $roles = DeviceRole::all();
        // Ubah dari 'device_roles.index' menjadi 'device_roles'
        return view('device_roles', compact('roles'));
    }

    public function create()
    {
        return view('create_device_role');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'color' => 'required',
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'color' => 'required',
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