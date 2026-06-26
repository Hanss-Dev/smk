<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PopupController extends Controller
{
    public function index()
    {
        $popups = Popup::orderBy('id', 'desc')->get();
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
            $file->move(public_path('uploads/popup'), $fileName);
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
                $oldPath = public_path('uploads/popup/' . $popup->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $file = $request->file('image');
            $fileName = time() . '-' . basename($file->getClientOriginalName());
            $file->move(public_path('uploads/popup'), $fileName);
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
            $imagePath = public_path('uploads/popup/' . $popup->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $popup->delete();

        return redirect()->route('admin.popup.index')->with('success', 'Popup berhasil dihapus');
    }
}
