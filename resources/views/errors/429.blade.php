@extends('layouts.app')

@section('title', '429 - Terlalu Banyak Permintaan')

@section('content')
<main>
  <section class="error-page-section">
    <div class="error-container">
      <h1 class="error-code">429</h1>
      <h2 class="error-title">Terlalu Banyak Permintaan</h2>
      <p class="error-desc">Anda telah mengirimkan terlalu banyak permintaan dalam waktu singkat. Silakan tunggu beberapa saat lalu coba lagi nanti.</p>
      <a href="{{ route('home') }}" class="btn-back-home">
        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
      </a>
    </div>
  </section>
</main>
@endsection
