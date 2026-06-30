@extends('layouts.app')

@section('title', '403 - Akses Terlarang')

@section('content')
<main>
  <section class="error-page-section">
    <div class="error-container">
      <h1 class="error-code">403</h1>
      <h2 class="error-title">Akses Terlarang</h2>
      <p class="error-desc">Maaf, Anda tidak memiliki hak akses yang memadai untuk melihat halaman ini.</p>
      <a href="{{ route('home') }}" class="btn-back-home">
        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
      </a>
    </div>
  </section>
</main>
@endsection
