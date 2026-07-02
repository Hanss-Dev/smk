@extends('layouts.app')

@section('title', '419 - Halaman Kedaluwarsa')

@section('content')
<main>
  <section class="error-page-section">
    <div class="error-container">
      <h1 class="error-code">419</h1>
      <h2 class="error-title">Halaman Telah Kedaluwarsa</h2>
      <p class="error-desc">Sesi Anda telah berakhir karena terlalu lama tidak ada aktivitas. Silakan muat ulang halaman ini atau coba login kembali.</p>
      <a href="{{ route('home') }}" class="btn-back-home">
        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
      </a>
    </div>
  </section>
</main>
@endsection
