<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumni;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AlumniController extends Controller
{
    public function index()
    {
        $alumnilist = Alumni::orderBy('id', 'desc')->get();
        return view('admin.alumni.index', compact('alumnilist'));
    }

    public function create()
    {
        return view('admin.alumni.create');
    }

    public function store(Request $request)
    {
         $request->validate([
            'NamaSiswa' => 'required|string|max:150',
            'GambarAlumni' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'AlumniJurusan' => 'required|string',
            'NamaPekerjaan' => 'required|string',
            'NamaPerusahaan' => 'required|string',
        ]);

        $fileName = null;
        if ($request->hasFile('GambarAlumni')) {
            $file = $request->file('GambarAlumni');
            $fileName = time() . '-' . basename($file->getClientOriginalName());
            $file->move(public_path('uploads/Alumni'), $fileName);
        }

        Alumni::create([
            'nama_alumni' => $request->NamaSiswa,
            'image' => $fileName,
            'jurusan_alumni' => $request->AlumniJurusan,
            'nama_pekerjaan' => $request->NamaPekerjaan,
            'nama_perusahaan' => $request->NamaPerusahaan,
        ]);

        return redirect()->route('admin.alumni.index')->with('success', 'Data Alumni berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('admin.alumni.edit', compact('alumni'));
    }

    public function update(Request $request, string $id)
    {
       $request->validate([
            'NamaSiswa' => 'nullable|string|max:150',
            'GambarAlumni' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'AlumniJurusan' => 'nullable|string',
            'NamaPekerjaan' => 'nullable|string',
            'NamaPerusahaan' => 'nullable|string',
        ]);

        $alumni = Alumni::findOrFail($id);
        $fileName = $alumni->image;

        if ($request->hasFile('GambarAlumni')) {
            // Delete old thumbnail if exists
            if ($alumni->image) {
                $oldPath = public_path('uploads/alumni/' . $alumni->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $file = $request->file('GambarAlumni');
            $fileName = time() . '-' . basename($file->getClientOriginalName());
            $file->move(public_path('uploads/Alumni'), $fileName);
        }

        $alumni->update([
            'nama_alumni' => $request->NamaSiswa,
            'image' => $fileName,
            'jurusan_alumni' => $request->AlumniJurusan,
            'nama_pekerjaan' => $request->NamaPekerjaan,
            'nama_perusahaan' => $request->NamaPerusahaan,
        ]);

        return redirect()->route('admin.alumni.index')->with('success', 'Data Alumni berhasil diperbarui'); 
    }

    public function destroy(string $id)
    {
        $alumni = Alumni::findOrFail($id);

        if ($alumni->image) {
            $imagePath = public_path('uploads/Alumni/' . $alumni->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $alumni->delete();

        return redirect()->route('admin.alumni.index')->with('success', 'Data Alumni berhasil dihapus');
    }
}
