<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function index()
    {
        $platforms = Platform::all();
        return view('platforms', compact('platforms'));
    }

    public function create()
    {
        $manufacturers = Manufacturer::all();
        return view('create_platform', compact('manufacturers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'manufacturer_id' => 'nullable|exists:manufacturers,id',
            'description' => 'nullable|string',
        ]);

        Platform::create($validated);

        return redirect()->route('platforms.index')->with('success', 'Platform berhasil ditambahkan!');
    }

    // --- Tambahan Method untuk Edit & Update ---

    public function edit($id)
    {
        $platform = Platform::findOrFail($id);
        $manufacturers = Manufacturer::all();
        return view('edit_platform', compact('platform', 'manufacturers'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'manufacturer_id' => 'nullable|exists:manufacturers,id',
            'description' => 'nullable|string',
        ]);

        $platform = Platform::findOrFail($id);
        $platform->update($validated);

        return redirect()->route('platforms.index')->with('success', 'Platform berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $platform = Platform::findOrFail($id);
        $platform->delete();

        return redirect()->route('platforms.index')->with('success', 'Platform berhasil dihapus!');
    }
}