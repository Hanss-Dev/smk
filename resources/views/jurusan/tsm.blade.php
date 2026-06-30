@extends('layouts.app')

@section('title', 'Teknik Bisnis Sepeda Motor - SMK Mitra Industri MM2100')

@section('content')
<article class="jurusan-article">
  <header class="article-header hero-tbsm">
    <div class="overlay">
      <h1>Teknik Bisnis Sepeda Motor</h1>
      <p>Ahli servis sepeda motor dengan jiwa wirausaha.</p>
    </div>
  </header>

  <section class="article-content">
    <h2>Pengenalan Jurusan</h2>
    <p>Jurusan ini menggabungkan keterampilan teknis sepeda motor dengan pengetahuan bisnis dan manajemen bengkel.</p>

    <h2>Program Unggulan</h2>
    <p>Untuk mendukung kompetensi siswa, jurusan ini memiliki beberapa program unggulan:</p>
    <ul>
      <li>🏍️ Perawatan & Servis Motor</li>
      <li>📦 Manajemen Bengkel</li>
      <li>🏭 Praktik Kerja Lapangan</li>
    </ul>

    <h2>Prospek Karir</h2>
    <p>Teknisi sepeda motor, service advisor, atau wirausaha bengkel mandiri.</p>
  </section>

  <section class="jurusan-gallery">
    <div class="jurusan-gallery__header">
      <h2>Galeri Kegiatan Jurusan TBSM</h2>
      <p>Dokumentasi praktik servis, perawatan, dan manajemen bengkel sepeda motor.</p>
    </div>

    <div class="jurusan-gallery__grid">
      @if (!empty($galleryImages))
        @foreach ($galleryImages as $index => $imgData)
          <figure class="gallery-item {{ $index === 0 ? 'gallery-item--main' : '' }}">
            <img src="{{ asset('storage/jurusan/' . $imgData['image']) }}" alt="{{ $imgData['alt'] ?? '' }}">
            @if (!empty($imgData['alt']))
              <figcaption>{{ $imgData['alt'] }}</figcaption>
            @endif
          </figure>
        @endforeach
      @else
        <figure class="gallery-item gallery-item--main">
          <img src="{{ asset('assets/img/TSM/TSM.jpg') }}" alt="Praktik Servis & Perawatan Sepeda Motor">
          <figcaption>Praktik Servis & Perawatan Sepeda Motor</figcaption>
        </figure>

        <figure class="gallery-item">
          <img src="{{ asset('assets/img/TSM/TSM.jpg') }}" alt="Suasana Bengkel TSM">
          <figcaption>Suasana Bengkel TSM</figcaption>
        </figure>

        <figure class="gallery-item">
          <img src="{{ asset('assets/img/TSM/TSM.jpg') }}" alt="Pembelajaran Teknik & Bisnis Bengkel">
          <figcaption>Pembelajaran Teknik & Bisnis Bengkel</figcaption>
        </figure>

        <figure class="gallery-item">
          <img src="{{ asset('assets/img/TSM/TSM.jpg') }}" alt="Praktik Kerja & Persiapan Industri">
          <figcaption>Praktik Kerja & Persiapan Industri</figcaption>
        </figure>
      @endif
    </div>
  </section>
</article>
@endsection
