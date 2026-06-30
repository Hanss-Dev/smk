<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PopupController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $perPage = request('per_page', 20);
        $perPage = $perPage === 'all' ? 999999 : (int) $perPage;

        $popups = Popup::query()
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        return view('admin.popup.index', compact('popups'));
    }

    public function create()
    {
        return view('admin.popup.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . basename($file->getClientOriginalName());
            $file->storeAs('popup', $fileName, 'public');
        }

        Popup::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $fileName,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.popup.index')->with('success', 'Popup berhasil ditambahkan');
    }

    public function edit($id)
    {
        $popup = Popup::findOrFail($id);
        return view('admin.popup.edit', compact('popup'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $popup = Popup::findOrFail($id);
        $fileName = $popup->image;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($popup->image) {
                Storage::disk('public')->delete('popup/' . $popup->image);
            }

            $file = $request->file('image');
            $fileName = time() . '-' . basename($file->getClientOriginalName());
            $file->storeAs('popup', $fileName, 'public');
        }

        $popup->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $fileName,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.popup.index')->with('success', 'Popup berhasil diperbarui');
    }

    public function destroy($id)
    {
        $popup = Popup::findOrFail($id);

        if ($popup->image) {
            Storage::disk('public')->delete('popup/' . $popup->image);
        }

        $popup->delete();

        return redirect()->route('admin.popup.index')->with('success', 'Popup berhasil dihapus');
    }
}
