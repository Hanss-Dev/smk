<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentJurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ContentJurusanController extends Controller
{
    private array $jurusanList = [
        'Teknik Instalasi Tenaga Listrik',
        'Teknik Elektronika Industri',
        'Teknik Mesin',
        'Teknik Kendaraan Ringan Otomotif',
        'Teknik Bisnis Sepeda Motor',
        'Teknik Kimia Industri',
        'Akuntansi',
        'Perhotelan',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = request('per_page', 20);
        $perPage = $perPage === 'all' ? 999999 : (int) $perPage;

        $jurusanFilter = request('jurusan');
        $jurusanList   = $this->jurusanList;

        $contents = ContentJurusan::when($jurusanFilter, fn($q) => $q->where('jurusan', $jurusanFilter))
            ->orderBy('jurusan')
            ->paginate($perPage);

        return view('admin.content-jurusan.index', compact('contents', 'jurusanList'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusanList = $this->jurusanList;
        return view('admin.content-jurusan.create', compact('jurusanList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jurusan'  => 'required|string',
            'images'   => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'alts'     => 'nullable|array',
            'alts.*'   => 'nullable|string|max:255',
        ]);

        $uploadPath = public_path('uploads/jurusan');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0775, true);
        }

        $content = [];
        foreach ($request->file('images') as $index => $file) {
            $fileName = time() . '-' . $index . '-' . $file->getClientOriginalName();
            $file->move($uploadPath, $fileName);
            $content[] = [
                'image' => $fileName,
                'alt'   => $request->alts[$index] ?? '',
            ];
        }

        ContentJurusan::create([
            'jurusan' => $request->jurusan,
            'content' => json_encode($content),
        ]);

        return redirect()
            ->route('admin.content-jurusan.index')
            ->with('success', 'Content Jurusan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contentJurusan = ContentJurusan::findOrFail($id);

        // Handle both string (raw JSON) and array (cast) content
        $images = is_string($contentJurusan->content)
            ? json_decode($contentJurusan->content, true)
            : ($contentJurusan->content ?? []);

        $jurusanList = $this->jurusanList;

        return view('admin.content-jurusan.edit', compact('contentJurusan', 'images', 'jurusanList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * Logic:
     *  1. Images still in the form  (existing_images[]) → keep + update their alt.
     *  2. Images in DB but NOT in form → deleted from disk automatically.
     *  3. New file uploads (images[]) → saved and appended.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jurusan'         => 'required|string',
            'images'          => 'nullable|array',
            'images.*'        => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'alts'            => 'nullable|array',
            'alts.*'          => 'nullable|string|max:255',
            'existing_images' => 'nullable|array',
            'existing_alts'   => 'nullable|array',
        ]);

        $contentJurusan = ContentJurusan::findOrFail($id);
        $uploadPath     = public_path('uploads/jurusan');

        // Current images stored in DB
        $currentContent = is_string($contentJurusan->content)
            ? json_decode($contentJurusan->content, true)
            : ($contentJurusan->content ?? []);

        // Image names that the user chose to keep (hidden inputs still in DOM)
        $existingImages = $request->existing_images ?? [];   // [key => filename]
        $existingAlts   = $request->existing_alts   ?? [];   // [key => alt]
        $keptNames      = array_values($existingImages);

        // Delete images that were removed from the form
        foreach ((array) $currentContent as $item) {
            if (!in_array($item['image'], $keptNames)) {
                $path = $uploadPath . DIRECTORY_SEPARATOR . $item['image'];
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
        }

        // Rebuild content array from kept images (with potentially updated alts)
        $finalContent = [];
        foreach ($existingImages as $key => $imgName) {
            $finalContent[] = [
                'image' => $imgName,
                'alt'   => $existingAlts[$key] ?? '',
            ];
        }

        // Append newly uploaded images
        if ($request->hasFile('images')) {
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }
            foreach ($request->file('images') as $index => $file) {
                $fileName = time() . '-' . $index . '-' . $file->getClientOriginalName();
                $file->move($uploadPath, $fileName);
                $finalContent[] = [
                    'image' => $fileName,
                    'alt'   => $request->alts[$index] ?? '',
                ];
            }
        }

        $contentJurusan->update([
            'jurusan' => $request->jurusan,
            'content' => json_encode(array_values($finalContent)),
        ]);

        return redirect()
            ->route('admin.content-jurusan.index')
            ->with('success', 'Content Jurusan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * Also deletes all associated image files from disk.
     */
    public function destroy(string $id)
    {
        $contentJurusan = ContentJurusan::findOrFail($id);

        $images = is_string($contentJurusan->content)
            ? json_decode($contentJurusan->content, true)
            : ($contentJurusan->content ?? []);

        foreach ((array) $images as $item) {
            $path = public_path('uploads/jurusan/' . $item['image']);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $contentJurusan->delete();

        return redirect()
            ->route('admin.content-jurusan.index')
            ->with('success', 'Content Jurusan berhasil dihapus.');
    }
}