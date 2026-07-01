<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keungulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KeungulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 20);
        $perPage = $perPage === 'all' ? 999999 : (int) $perPage;

        $search = $request->get('search');

        $keunggulan = Keungulan::query()
            ->when($search, fn ($q) => $q->where('nama_keunggulan', 'like', "%{$search}%"))
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->appends($request->except('page'));

        return view('admin.keungulan.index', compact('keunggulan', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.keungulan.create');
    }

    /**
     * Store a newly created resource in storage.
     * Supports single or multiple image uploads.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_keunggulan'   => 'required|array|min:1',
            'nama_keunggulan.*' => 'required|string|max:255',
            'images'            => 'required|array|min:1',
            'images.*'          => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'alts'              => 'nullable|array',
            'alts.*'            => 'nullable|string|max:255',
            'is_active'         => 'nullable|boolean',
        ]);

        $images   = $request->file('images');
        $names    = $request->input('nama_keunggulan', []);
        $alts     = $request->input('alts', []);
        $isActive = $request->boolean('is_active', true);

        foreach ($images as $i => $file) {
            $fileName = time() . '-' . $i . '-' . basename($file->getClientOriginalName());
            $file->storeAs('keungulan', $fileName, 'public');

            Keungulan::create([
                'nama_keunggulan' => $names[$i] ?? null,
                'image'           => $fileName,
                'alt'             => $alts[$i] ?? null,
                'is_active'       => $isActive,
            ]);
        }

        return redirect()->route('admin.keungulan.index')
            ->with('success', 'Keunggulan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keungulan $keungulan)
    {
        return view('admin.keungulan.edit', compact('keungulan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keungulan $keungulan)
    {
        $request->validate([
            'nama_keunggulan' => 'required|string|max:255',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'alt'             => 'nullable|string|max:255',
            'is_active'       => 'nullable|boolean',
        ]);

        $fileName = $keungulan->image;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($keungulan->image) {
                Storage::disk('public')->delete('keungulan/' . $keungulan->image);
            }

            $file     = $request->file('image');
            $fileName = time() . '-' . basename($file->getClientOriginalName());
            $file->storeAs('keungulan', $fileName, 'public');
        }

        $keungulan->update([
            'nama_keunggulan' => $request->nama_keunggulan,
            'image'           => $fileName,
            'alt'             => $request->alt,
            'is_active'       => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.keungulan.index')
            ->with('success', 'Keunggulan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keungulan $keungulan)
    {
        if ($keungulan->image) {
            Storage::disk('public')->delete('keungulan/' . $keungulan->image);
        }

        $keungulan->delete();

        return redirect()->route('admin.keungulan.index')
            ->with('success', 'Keunggulan berhasil dihapus');
    }
}
