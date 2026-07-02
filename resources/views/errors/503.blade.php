@extends('layouts.app')

@section('title', '503 - Layanan Tidak Tersedia')

@section('content')
<main>
  <section class="error-page-section">
    <div class="error-container">
      <h1 class="error-code">503</h1>
      <h2 class="error-title">Layanan Sedang Dalam Pemeliharaan</h2>
      <p class="error-desc">Maaf, sistem kami saat ini sedang dalam pemeliharaan atau tidak dapat menangani permintaan. Silakan kembali beberapa saat lagi.</p>
      <a href="{{ route('home') }}" class="btn-back-home">
        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
      </a>
    </div>
  </section>
</main>
@endsection
