@extends('layouts.app')

@section('title', 'Teknik Kendaraan Ringan Otomotif - SMK Mitra Industri MM2100')

@section('content')
<article class="jurusan-article">
  <header class="article-header hero-tkro">
    <div class="overlay">
      <h1>Teknik Kendaraan Ringan Otomotif</h1>
      <p>Menghasilkan teknisi otomotif handal dan berdaya saing tinggi.</p>
    </div>
  </header>

  <section class="article-content">
    <h2>Pengenalan Jurusan</h2>
    <p>Jurusan ini mempelajari perawatan, perbaikan, dan diagnosa kendaraan roda empat berbasis teknologi otomotif modern.</p>

    <h2>Program Unggulan</h2>
    <p>Untuk mendukung kompetensi siswa, jurusan ini memiliki beberapa program unggulan:</p>
    <ul>
      <li>🚗 Servis & Tune Up Mesin</li>
      <li>🔧 Sistem Kelistrikan Kendaraan</li>
      <li>🏭 Magang Bengkel & Dealer</li>
    </ul>

    <h2>Prospek Karir</h2>
    <p>Bekerja di bengkel, dealer resmi, industri otomotif, atau membuka usaha bengkel sendiri.</p>
  </section>

  <section class="jurusan-gallery">
    <div class="jurusan-gallery__header">
      <h2>Galeri Kegiatan TKRO</h2>
      <p>Dokumentasi praktik servis, perawatan, dan sistem otomotif.</p>
    </div>

    <div class="jurusan-gallery__grid">
      <figure class="gallery-item gallery-item--main">
        <img src="{{ asset('assets/img/TKR/tkr2.jpg') }}" alt="Praktik Servis & Tune Up Kendaraan">
        <figcaption>Praktik Servis & Tune Up Kendaraan</figcaption>
      </figure>

      <figure class="gallery-item">
        <img src="{{ asset('assets/img/TKR/TKR.jpg') }}" alt="Sistem Kelistrikan Kendaraan">
        <figcaption>Sistem Kelistrikan Kendaraan</figcaption>
      </figure>

      <figure class="gallery-item">
        <img src="https://dummyimage.com/600x400/000/fff" alt="Diagnosa Mesin Otomotif">
        <figcaption>Diagnosa Mesin Otomotif</figcaption>
      </figure>

      <figure class="gallery-item">
        <img src="https://dummyimage.com/600x400/000/fff" alt="Workshop & Bengkel TKRO">
        <figcaption>Workshop & Bengkel TKRO</figcaption>
      </figure>
    </div>
  </section>
</article>
@endsection
