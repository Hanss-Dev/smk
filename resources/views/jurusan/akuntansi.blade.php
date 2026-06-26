@extends('layouts.app')

@section('title', 'Akuntansi - SMK Mitra Industri MM2100')

@section('content')
<article class="jurusan-article">
  <header class="article-header hero-akutansi">
    <div class="overlay">
      <h1>Akuntansi</h1>
      <p>Mencetak tenaga administrasi dan keuangan profesional.</p>
    </div>
  </header>

  <section class="article-content">
    <h2>Pengenalan Jurusan</h2>
    <p>Jurusan Akuntansi membekali siswa dengan kemampuan pencatatan, pengelolaan keuangan, dan penggunaan software akuntansi.</p>

    <h2>Program Unggulan</h2>
    <p>Untuk mendukung kompetensi siswa, jurusan ini memiliki beberapa program unggulan:</p>
    <ul>
      <li>📊 Akuntansi Keuangan</li>
      <li>💻 Aplikasi Akuntansi</li>
      <li>🏢 PKL Perkantoran</li>
    </ul>

    <h2>Prospek Karir</h2>
    <p>Staf keuangan, administrasi, atau melanjutkan pendidikan akuntansi.</p>
  </section>

  <section class="jurusan-gallery">
    <div class="jurusan-gallery__header">
      <h2>Galeri Kegiatan Jurusan Akuntansi</h2>
      <p>Dokumentasi pembelajaran, praktik, dan aktivitas siswa.</p>
    </div>

    <div class="jurusan-gallery__grid">
      <figure class="gallery-item gallery-item--main">
        <img src="{{ asset('assets/img/AKUNTANSI/AKUNTANSI.jpg') }}" alt="Praktik Akuntansi & Administrasi Keuangan">
        <figcaption>Praktik Akuntansi & Administrasi Keuangan</figcaption>
      </figure>

      <figure class="gallery-item">
        <img src="{{ asset('assets/img/AKUNTANSI/AKUNTANSI.jpg') }}" alt="Kegiatan Siswa Akuntansi">
        <figcaption>Kegiatan Siswa Akuntansi</figcaption>
      </figure>

      <figure class="gallery-item">
        <img src="{{ asset('assets/img/AKUNTANSI/AKUNTANSI.jpg') }}" alt="Suasana Pembelajaran">
        <figcaption>Suasana Pembelajaran</figcaption>
      </figure>

      <figure class="gallery-item">
        <img src="{{ asset('assets/img/AKUNTANSI/AKUNTANSI.jpg') }}" alt="Praktik Software Akuntansi">
        <figcaption>Praktik Software Akuntansi</figcaption>
      </figure>
    </div>
  </section>
</article>
@endsection
