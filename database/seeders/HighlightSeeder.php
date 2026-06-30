<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Highlight;
use Illuminate\Support\Facades\Storage;

class HighlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Menggunakan gambar asli dari public/assets/img/slider1.jpeg
     * dan menyimpannya ke storage/app/public/highlight/ dengan nama
     * berformat {timestamp}-{originalName} sesuai konvensi HighlightController.
     */
    public function run(): void
    {
        // Nama file seed dengan format timestamp-originalName (sesuai HighlightController@store)
        $imageName = '1769685434-slider1.jpeg';
        $storagePath = 'highlight/' . $imageName;

        // Sumber gambar asli dari assets
        $sourcePath = public_path('assets/img/slider1.jpeg');

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

        Highlight::create([
            'id'          => 3,
            'title'       => 'Where does it come from?',
            'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.',
            'image'       => $imageName,
            'is_active'   => 1,
        ]);
    }
}
