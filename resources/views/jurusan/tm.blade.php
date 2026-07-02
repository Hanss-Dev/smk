@extends('layouts.app')

@section('title', 'Teknik Mesin - SMK Mitra Industri MM2100')

@section('content')
<article class="jurusan-article">
  <header class="article-header hero-tm">
    <div class="overlay">
      <h1>Teknik Mesin</h1>
      <p>Mencetak tenaga terampil di bidang manufaktur dan permesinan industri.</p>
    </div>
  </header>

  <section class="article-content">
    <h2>Pengenalan Jurusan</h2>
    <p>Jurusan Teknik Mesin fokus pada proses pemesinan, pengelasan, dan teknik produksi yang digunakan dalam industri manufaktur modern.</p>

    <h2>Program Unggulan</h2>
    <p>Untuk mendukung kompetensi siswa, jurusan ini memiliki beberapa program unggulan:</p>
    <ul>
      <li>🔩 Pemesinan Manual & CNC</li>
      <li>🔥 Teknik Pengelasan</li>
      <li>🏭 Magang Industri Manufaktur</li>
    </ul>

    <h2>Prospek Karir</h2>
    <p>Lulusan dapat bekerja sebagai operator mesin, teknisi produksi, atau tenaga kerja industri manufaktur.</p>
  </section>

  <section class="jurusan-gallery">
    <div class="jurusan-gallery__header">
      <h2>Galeri Kegiatan Teknik Mesin</h2>
      <p>Dokumentasi praktik pemesinan dan proses manufaktur.</p>
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
          <img src="{{ asset('assets/img/MESIN/MESIN-NGIKIR.JPG') }}" alt="Praktik Pemesinan & Produksi">
          <figcaption>Praktik Pemesinan & Produksi</figcaption>
        </figure>

        <figure class="gallery-item">
          <img src="{{ asset('assets/img/MESIN/MESIN.jpg') }}" alt="Pengoperasian Mesin CNC">
          <figcaption>Pengoperasian Mesin CNC</figcaption>
        </figure>

        <figure class="gallery-item">
          <img src="https://dummyimage.com/600x400/000/fff" alt="Teknik Pengelasan">
          <figcaption>Teknik Pengelasan</figcaption>
        </figure>

        <figure class="gallery-item">
          <img src="https://dummyimage.com/600x400/000/fff" alt="Workshop & Bengkel Mesin">
          <figcaption>Workshop & Bengkel Mesin</figcaption>
        </figure>
      @endif
    </div>
  </section>
</article>
@endsection
