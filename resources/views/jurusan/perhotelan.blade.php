@extends('layouts.app')

@section('title', 'Perhotelan - SMK Mitra Industri MM2100')

@section('content')
<article class="jurusan-article">
  <header class="article-header hero-hotel">
    <div class="overlay">
      <h1>Perhotelan</h1>
      <p>Profesional muda di bidang hospitality dan pelayanan.</p>
    </div>
  </header>

  <section class="article-content">
    <h2>Pengenalan Jurusan</h2>
    <p>Mempelajari pelayanan hotel, tata boga, housekeeping, dan front office sesuai standar industri.</p>

    <h2>Program Unggulan</h2>
    <p>Untuk mendukung kompetensi siswa, jurusan ini memiliki beberapa program unggulan:</p>
    <ul>
      <li>🏨 Housekeeping</li>
      <li>🍽️ Food & Beverage Service</li>
      <li>🏭 Magang Hotel</li>
    </ul>

    <h2>Prospek Karir</h2>
    <p>Bekerja di hotel, restoran, atau industri pariwisata.</p>
  </section>

  <section class="jurusan-gallery">
    <div class="jurusan-gallery__header">
      <h2>Galeri Kegiatan Jurusan Perhotelan</h2>
      <p>Dokumentasi praktik pelayanan, tata boga, dan aktivitas hospitality siswa.</p>
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
          <img src="{{ asset('assets/img/HOTEL/HOTEL.jpg') }}" alt="Praktik Pelayanan Hotel & Hospitality">
          <figcaption>Praktik Pelayanan Hotel & Hospitality</figcaption>
        </figure>

        <figure class="gallery-item">
          <img src="{{ asset('assets/img/HOTEL/hotel2.jpg') }}" alt="Housekeeping & Room Service">
          <figcaption>Housekeeping & Room Service</figcaption>
        </figure>

        <figure class="gallery-item">
          <img src="https://dummyimage.com/600x400/000/fff" alt="Food & Beverage Service">
          <figcaption>Food & Beverage Service</figcaption>
        </figure>

        <figure class="gallery-item">
          <img src="https://dummyimage.com/600x400/000/fff" alt="Front Office & Pelayanan Tamu">
          <figcaption>Front Office & Pelayanan Tamu</figcaption>
        </figure>
      @endif
    </div>
  </section>
</article>
@endsection
