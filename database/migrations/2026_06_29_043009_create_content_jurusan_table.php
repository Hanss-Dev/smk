<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('content_kegiatan_jurusan', function (Blueprint $table) {
            $table->id();
            $table->enum('jurusan', [
                'Teknik Instalasi Tenaga Listrik',
                'Teknik Elektronika Industri',
                'Teknik Mesin',
                'Teknik Kendaraan Ringan Otomotif',
                'Teknik Bisnis Sepeda Motor',
                'Teknik Kimia Industri',
                'Akuntansi',
                'Perhotelan'
            ])->nullable();
            $table->json('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_jurusan');
    }
};
