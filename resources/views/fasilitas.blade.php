@extends('layouts.app')

@section('title', 'Fasilitas - SMK Mitra Industri MM2100')

@section('content')
<section id="fasilitas">
  <div class="fasilitas-container">
    <div class="fasilitas-header">
      <h2>Fasilitas</h2>
      <div class="fasilitas-divider"></div>
    </div>

    <div class="fasilitas-grid">
      <!-- Card 1 -->
      <div class="fasilitas-card">
        <div class="fasilitas-image">
          <img src="https://images.unsplash.com/photo-1562774053-701939374585?w=800&q=80" alt="Gedung Utama">
          <div class="fasilitas-overlay">
            <h3>Gedung Utama</h3>
            <p>Fasilitas pembelajaran modern dengan AC di setiap ruang kelas</p>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="fasilitas-card">
        <div class="fasilitas-image">
          <img src="https://images.unsplash.com/photo-1581094271901-8022df4466f9?w=800&q=80" alt="Laboratorium CNC">
          <div class="fasilitas-overlay">
            <h3>Laboratorium CNC</h3>
            <p>Mesin CNC terkini untuk praktik pemesinan presisi tinggi</p>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="fasilitas-card">
        <div class="fasilitas-image">
          <img src="https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=800&q=80" alt="Bengkel TKR & TBSM">
          <div class="fasilitas-overlay">
            <h3>Bengkel TKR & TBSM</h3>
            <p>Workshop lengkap dengan peralatan standar industri otomotif</p>
          </div>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="fasilitas-card">
        <div class="fasilitas-image">
          <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=800&q=80" alt="Ruang Serbaguna">
          <div class="fasilitas-overlay">
            <h3>Ruang Serbaguna</h3>
            <p>Aula besar untuk kegiatan sekolah dan pelatihan industri</p>
          </div>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="fasilitas-card">
        <div class="fasilitas-image">
          <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&q=80" alt="Lab Elektronika">
          <div class="fasilitas-overlay">
            <h3>Lab Elektronika</h3>
            <p>Laboratorium modern untuk praktik elektronika dan PLC</p>
          </div>
        </div>
      </div>

      <!-- Card 6 -->
      <div class="fasilitas-card">
        <div class="fasilitas-image">
          <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=800&q=80" alt="Perpustakaan Digital">
          <div class="fasilitas-overlay">
            <h3>Perpustakaan Digital</h3>
            <p>Koleksi buku dan akses e-learning untuk mendukung pembelajaran</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
