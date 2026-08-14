@extends('layouts.app')

@section('title', 'Profil Sekolah - SMK Mitra Industri MM2100')

@section('content')
<section class="breadcrumbs">
  <div class="breadcrumbs-bg" style="background-image:url('https://smkind-mm2100.sch.id/wp-content/uploads/2025/03/WhatsApp-Image-2025-03-21-at-13.39.29.jpeg')">
    <div class="overlayy"></div>
    <div class="container">
      <h1 class="page-title">Profile</h1>
      <div class="breadcrumbs-nav">
        <a href="{{ route('home') }}">SMK Mitra Industri MM2100</a>
        <span>&gt;</span>
        <span class="current">Profile</span>
      </div>
    </div>
  </div>
</section>

<section id="profil" class="profil-section">
  <div class="container">
    <div class="profil-grid">
      <div class="profil-text">
        <h3 class="profil-subtitle">Sejarah Singkat</h3>
        <p class="profil-paragraph">
          SMK Mitra Industri didirikan pada tahun 1996 dengan visi menjadi sekolah kejuruan terdepan yang menghasilkan tenaga kerja terampil dan profesional. Berlokasi strategis di kawasan industri MM2100, kami memiliki akses langsung ke lebih dari 1.500 perusahaan nasional dan multinasional.
        </p>
        <p class="profil-paragraph">
          Sebagai sekolah berbasis kawasan industri, kami menjalin kemitraan erat dengan perusahaan-perusahaan besar seperti Toyota, Panasonic, Yamaha, Astra, dan banyak lagi. Hal ini memungkinkan siswa kami mendapatkan pengalaman industri nyata melalui program magang dan pelatihan langsung di perusahaan.
        </p>
      </div>

      <div class="profil-box">
        <h3 class="profil-subtitle">Dikelilingi Perusahaan Besar</h3>
        <p class="profil-paragraph">
          Lebih dari 95% lulusan kami terserap di industri dalam waktu 6 bulan setelah kelulusan, dengan banyak yang bekerja di perusahaan multinasional ternama.
        </p>
        <div class="profil-stats-grid">
          <div class="profil-stat">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
              <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/>
              <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/>
              <path d="M10 6h4M10 10h4M10 14h4M10 18h4"/>
            </svg>
            <span>1500+ Perusahaan</span>
          </div>
          <div class="profil-stat">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
              <path d="M16 3.128a4 4 0 0 1 0 7.744"/>
              <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
              <circle cx="9" cy="7" r="4"/>
            </svg>
            <span>95% Terserap</span>
          </div>
          <div class="profil-stat">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/>
              <circle cx="12" cy="8" r="6"/>
            </svg>
            <span>Terakreditasi A</span>
          </div>
          <div class="profil-stat">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <circle cx="12" cy="12" r="6"/>
              <circle cx="12" cy="12" r="2"/>
            </svg>
            <span>Standar Industri</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
