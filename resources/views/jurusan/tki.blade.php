@extends('layouts.app')

@section('title', 'Teknik Kimia Industri - SMK Mitra Industri MM2100')

@section('content')
<article class="jurusan-article">
  <header class="article-header hero-tei">
    <div class="overlay">
      <h1>Teknik Kimia Industri</h1>
      <p>Mencetak tenaga terampil di bidang proses kimia, pengolahan industri, dan teknologi manufaktur modern.</p>
    </div>
  </header>

  <section class="article-content">
    <h2>Pengenalan Jurusan</h2>
    <p>
      Jurusan Teknik Kimia Industri di SMK Mitra Industri MM2100 membekali siswa dengan kompetensi di bidang pengolahan bahan kimia, pengendalian proses industri, serta teknologi produksi modern. Pembelajaran dirancang sesuai kebutuhan dunia industri dan manufaktur.
    </p>

    <h2>Program Unggulan</h2>
    <p>Untuk mendukung kompetensi siswa, jurusan ini memiliki beberapa program unggulan:</p>
    <ul>
      <li>🧪 Praktik Analisis Bahan Kimia</li>
      <li>🏭 Pengolahan Proses Industri</li>
      <li>⚗️ Praktik Kerja Lapangan di Industri Kimia</li>
    </ul>

    <h2>Prospek Karir</h2>
    <p>
      Lulusan Teknik Kimia Industri memiliki peluang kerja sebagai operator produksi industri kimia, quality control, analis laboratorium, teknisi pengolahan bahan, serta staf pengendalian proses industri.
    </p>
  </section>

  <section class="jurusan-gallery">
    <div class="jurusan-gallery__header">
      <h2>Galeri Kegiatan Teknik Kimia Industri</h2>
      <p>Dokumentasi praktik laboratorium, pengolahan bahan, dan proses industri kimia.</p>
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
          <img src="{{ asset('assets/img/TKI/TKI-NYEMPROT.JPG') }}" alt="Praktik Laboratorium Teknik Kimia Industri">
          <figcaption>Praktik Laboratorium Teknik Kimia Industri</figcaption>
        </figure>

        <figure class="gallery-item">
          <img src="https://dummyimage.com/600x400/000/fff" alt="Pengolahan Bahan Industri">
          <figcaption>Pengolahan Bahan Industri</figcaption>
        </figure>

        <figure class="gallery-item">
          <img src="https://dummyimage.com/600x400/000/fff" alt="Praktik Analisis Kimia">
          <figcaption>Praktik Analisis Kimia</figcaption>
        </figure>

        <figure class="gallery-item">
          <img src="https://dummyimage.com/600x400/000/fff" alt="Pembelajaran Berbasis Industri">
          <figcaption>Pembelajaran Berbasis Industri</figcaption>
        </figure>
      @endif
    </div>
  </section>
</article>
@endsection
