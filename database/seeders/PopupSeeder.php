<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Popup;
use Illuminate\Support\Facades\Storage;

class PopupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Menggunakan gambar asli dari public/assets/img/brosur-ppdbb.jpeg
     * dan menyimpannya ke storage/app/public/popup/ dengan nama
     * berformat {timestamp}-{originalName} sesuai konvensi PopupController.
     */
    public function run(): void
    {
        // Nama file seed dengan format timestamp-originalName (sesuai PopupController@store)
        $imageName   = '1769688794-brosur-ppdbb.jpeg';
        $storagePath = 'popup/' . $imageName;

        // Sumber gambar asli dari assets
        $sourcePath = public_path('assets/img/brosur-ppdbb.jpeg');

        // Salin gambar asli ke storage jika belum ada
        if (!Storage::disk('public')->exists($storagePath)) {
            if (file_exists($sourcePath)) {
                // Salin gambar asli dari public/assets/img
                Storage::disk('public')->put($storagePath, file_get_contents($sourcePath));
            } else {
                // Fallback: buat gambar dummy 1x1 pixel grey jika file sumber tidak ditemukan
                $dummyImage = base64_decode('/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAP//////////////////////////////////////////////////////////////////////////////////////wgALCAABAAEBAREA/8QAFBABAAAAAAAAAAAAAAAAAAAAAP/aAAgBAQABPxA=');
                Storage::disk('public')->put($storagePath, $dummyImage);
            }
        }

        Popup::create([
            'id'         => 6,
            'title'      => 'Menu Pendaftaran Online',
            'content'    => 'Penerimaan Murid Baru TP. 2026/2027',
            'image'      => $imageName,
            'is_active'  => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
