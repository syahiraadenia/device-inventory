<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function index()
{
    // Hanya memanggil relasi yang ada di model
    $manufacturers = Manufacturer::withCount([
        'deviceTypes', 
        'inventoryItems', 
        'platforms'
    ])->get();

    return view('manufacturers', compact('manufacturers'));
}

    public function create()
    {
        return view('create_manufacturer');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Simpan ke PostgreSQL
        Manufacturer::create($validated);

        return redirect()->route('manufacturers.index')->with('success', 'Manufacturer berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        return view('edit_manufacturer', compact('manufacturer'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturer->update($validated);

        return redirect()->route('manufacturers.index')->with('success', 'Manufacturer berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturer->delete();

        return redirect()->route('manufacturers.index')->with('success', 'Manufacturer berhasil dihapus!');
    }
}