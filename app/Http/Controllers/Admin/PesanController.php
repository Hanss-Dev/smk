<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index()
    {
        $pesanList = Pesan::orderBy('tanggal', 'desc')->get();
        return view('admin.pesan.index', compact('pesanList'));
    }

    public function show($id)
    {
        $pesan = Pesan::findOrFail($id);

        if ($pesan->status === 'unread') {
            $pesan->update(['status' => 'read']);
        }

        return view('admin.pesan.read', compact('pesan'));
    }

    public function destroy($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();

        return redirect()->route('admin.pesan.index')->with('success', 'Pesan berhasil dihapus');
    }
}
