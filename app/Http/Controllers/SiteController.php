<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    // Menampilkan daftar site
    // Menampilkan daftar site
public function index(Request $request)
{
    // Hapus ->with(['region', 'group']) karena relasi tersebut tidak ada
    $query = Site::query(); 

    // Logika pencarian
    if ($request->filled('search')) {
        $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($request->search) . '%']);
    }

    $sites = $query->latest()->get();
    return view('sites', compact('sites'));
}

    // Menampilkan form untuk tambah site
    public function create() {
        return view('create_site');
    }

    // Menyimpan data site baru
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name'     => 'required|unique:sites|max:255',
            'slug'     => 'required|unique:sites|max:255',
            'status'   => 'required|string',
            'facility' => 'nullable|string',
        ]);

        Site::create($validatedData);
        return redirect()->route('sites.index')->with('success', 'Site berhasil ditambahkan!');
    }

    // Menampilkan form untuk edit site
    public function edit(string $id) {
        $site = Site::findOrFail($id);
        return view('edit_site', compact('site'));
    }

    // Memperbarui data site di database
    public function update(Request $request, string $id) {
        $validatedData = $request->validate([
            'name'     => 'required|max:255|unique:sites,name,' . $id,
            'slug'     => 'required|max:255|unique:sites,slug,' . $id,
            'status'   => 'required|string',
            'facility' => 'nullable|string',
        ]);

        $site = Site::findOrFail($id);
        $site->update($validatedData);
        
        return redirect()->route('sites.index')->with('success', 'Site berhasil diperbarui!');
    }

    // Menghapus data site
    public function destroy(string $id) {
        $site = Site::findOrFail($id);
        $site->delete();
        
        return redirect()->route('sites.index')->with('success', 'Site berhasil dihapus!');
    }
}