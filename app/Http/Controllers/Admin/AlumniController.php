<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumni;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $perPage = request('per_page', 20);
        $perPage = $perPage === 'all' ? 999999 : (int) $perPage;

        $search = request('search');

        $alumnilist = Alumni::when($search, function ($q) use ($search) {
                $q->where('nama_alumni', 'like', "%{$search}%")
                  ->orWhere('jurusan_alumni', 'like', "%{$search}%")
                  ->orWhere('nama_pekerjaan', 'like', "%{$search}%")
                  ->orWhere('nama_perusahaan', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);

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
            $file->storeAs('alumni', $fileName, 'public');
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
                Storage::disk('public')->delete('alumni/' . $alumni->image);
            }

            $file = $request->file('GambarAlumni');
            $fileName = time() . '-' . basename($file->getClientOriginalName());
            $file->storeAs('alumni', $fileName, 'public');
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
            Storage::disk('public')->delete('alumni/' . $alumni->image);
        }

        $alumni->delete();

        return redirect()->route('admin.alumni.index')->with('success', 'Data Alumni berhasil dihapus');
    }
}
