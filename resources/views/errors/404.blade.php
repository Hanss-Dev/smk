@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<main>
  <section class="error-page-section">
    <div class="error-container">
      <h1 class="error-code">404</h1>
      <h2 class="error-title">Oops! Halaman Tidak Ditemukan</h2>
      <p class="error-desc">Maaf, halaman yang Anda cari mungkin telah dihapus, namanya diubah, atau sementara tidak tersedia.</p>
      <a href="{{ route('home') }}" class="btn-back-home">
        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
      </a>
    </div>
  </section>
</main>
@endsection
