<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function index(Request $request)
    {
        // Hapus with('manufacturer') karena tidak lagi ditampilkan
        $query = Platform::withCount('devices');

        if ($request->filled('search')) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($request->search) . '%']);
        }

        $platforms = $query->latest()->get();
        return view('platforms', compact('platforms'));
    }

    public function create()
    {
        return view('create_platform'); // Hapus $manufacturers jika tidak dipakai
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Hapus manufacturer_id dari validasi store
        ]);

        Platform::create($validated);

        return redirect()->route('platforms.index')->with('success', 'Platform berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $platform = Platform::findOrFail($id);
        return view('edit_platform', compact('platform')); // Hapus $manufacturers
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Hapus manufacturer_id dari validasi update
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