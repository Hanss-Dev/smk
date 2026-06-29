<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function replyEmail(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $pesan = Pesan::findOrFail($id);

        try {
            Mail::send([], [], function ($message) use ($request) {
                $message->to($request->email)
                        ->subject($request->subject)
                        ->html(nl2br(e($request->message)));
            });

            // Mark as read when replied
            if ($pesan->status === 'unread') {
                $pesan->update(['status' => 'read']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Email berhasil dikirim ke ' . $request->email
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim email: ' . $e->getMessage()
            ], 500);
        }
    }

    public function markRead($id)
    {
        $pesan = Pesan::findOrFail($id);
        
        if ($pesan->status === 'unread') {
            $pesan->update(['status' => 'read']);
            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil ditandai sebagai dibaca'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pesan sudah dibaca sebelumnya'
        ]);
    }

    public function destroy($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();

        return redirect()->route('admin.pesan.index')->with('success', 'Pesan berhasil dihapus');
    }
}
