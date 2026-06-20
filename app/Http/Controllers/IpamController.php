<?php

namespace App\Http\Controllers;

use App\Models\Ipam;
use App\Models\Device; // Pastikan menggunakan model Device
use Illuminate\Http\Request;

class IPAMController extends Controller
{
    public function index() 
    {
        // Gunakan relasi device() sesuai model Ipam
        $ipams = Ipam::with('device')->get(); 
        return view('ipams', compact('ipams'));
    }

    public function create() 
    {
        $devices = Device::all(); 
        // Kirim $devices ke view
        return view('create_ipam', compact('devices'));
    }

    public function store(Request $request) 
{
    $validated = $request->validate([
        'device_id'  => 'required|exists:devices,id', 
        'ip_address' => 'required|ip|unique:ipam,ip_address',
        'gateway'    => 'nullable|ip'
    ]);
    
    // Gunakan $validated, bukan $request->all()
    Ipam::create($validated);
    
    return redirect()->route('ipam.index')->with('success', 'Data IP berhasil disimpan.');
}

    public function edit($id) 
    {
        $ipam = Ipam::findOrFail($id);
        $devices = Device::all();
        return view('edit_ipam', compact('ipam', 'devices'));
    }

    public function update(Request $request, $id) 
{
    $ipam = Ipam::findOrFail($id);
    
    $validated = $request->validate([
        'device_id'  => 'required|exists:devices,id',
        'ip_address' => 'required|ip|unique:ipam,ip_address,' . $ipam->id,
        'gateway'    => 'nullable|ip'
    ]);

    $ipam->update($validated);
    return redirect()->route('ipam.index')->with('success', 'Data IP berhasil diupdate.');
}

    public function destroy($id) 
    {
        $ipam = Ipam::findOrFail($id);
        $ipam->delete();
        return redirect()->route('ipam.index')->with('success', 'Data IP berhasil dihapus.');
    }
}