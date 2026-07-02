@extends('layouts.app')

@section('title', '500 - Terjadi Kesalahan Server')

@section('content')
<main>
  <section class="error-page-section">
    <div class="error-container">
      <h1 class="error-code">500</h1>
      <h2 class="error-title">Terjadi Kesalahan Server</h2>
      <p class="error-desc">Maaf, sedang ada masalah pada server kami. Silakan coba lagi beberapa saat, atau kembali ke halaman utama.</p>
      <a href="{{ route('home') }}" class="btn-back-home">
        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
      </a>
    </div>
  </section>
</main>
@endsection
