<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Highlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HighlightController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $perPage = request('per_page', 20);
        $perPage = $perPage === 'all' ? 999999 : (int) $perPage;

        $highlights = Highlight::query()
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        return view('admin.highlight.index', compact('highlights'));
    }

    public function create()
    {
        return view('admin.highlight.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . basename($file->getClientOriginalName());
            $file->storeAs('highlight', $fileName, 'public');
        }

        Highlight::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $fileName,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.highlight.index')->with('success', 'Highlight berhasil ditambahkan');
    }

    public function edit($id)
    {
        $highlight = Highlight::findOrFail($id);
        return view('admin.highlight.edit', compact('highlight'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $highlight = Highlight::findOrFail($id);
        $fileName = $highlight->image;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($highlight->image) {
                Storage::disk('public')->delete('highlight/' . $highlight->image);
            }

            $file = $request->file('image');
            $fileName = time() . '-' . basename($file->getClientOriginalName());
            $file->storeAs('highlight', $fileName, 'public');
        }

        $highlight->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $fileName,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.highlight.index')->with('success', 'Highlight berhasil diperbarui');
    }

    public function destroy($id)
    {
        $highlight = Highlight::findOrFail($id);

        if ($highlight->image) {
            Storage::disk('public')->delete('highlight/' . $highlight->image);
        }

        $highlight->delete();

        return redirect()->route('admin.highlight.index')->with('success', 'Highlight berhasil dihapus');
    }
}
