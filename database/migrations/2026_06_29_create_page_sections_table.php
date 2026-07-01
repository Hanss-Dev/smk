<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel ini dipakai bersama oleh Podcast, Lab Komputer, dan Safety Riding.
     * Setiap halaman disimpan sebagai 1 row dengan page_key unik.
     * Konten disimpan sebagai JSON array of sections / elements.
     *
     * Struktur JSON content:
     * [
     *   {
     *     "type": "section",
     *     "nama": "Nama Bagian",
     *     "elemen": [
     *       { "type": "text",  "value": "..." },
     *       { "type": "image", "value": "namafile.jpg", "alt": "Alt text" },
     *       { "type": "link",  "value": "https://...", "label": "Teks link" }
     *     ]
     *   }
     * ]
     */
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            // 'podcast' | 'lab-komputer' | 'safety-riding'
            $table->string('page_key', 60)->unique();
            $table->string('page_title', 150)->nullable();
            $table->json('content')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
