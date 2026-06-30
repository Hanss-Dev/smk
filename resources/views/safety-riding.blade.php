@extends('layouts.app')

@section('title', 'Safety Riding - SMK Mitra Industri MM2100')

@section('content')
<section class="safety-section">
  <div class="container">
    <div class="safety-header text-center">
      <h2>🏍️ Safety Riding</h2>
      <p>Edukasi keselamatan berkendara bagi siswa SMK Mitra Industri MM2100.</p>
    </div>

    @if (!empty($sections))
      @foreach ($sections as $section)
        @php
          $isHero = false;
          $hasImage = false;
          
          if (count($section['cards']) === 1) {
              $firstCard = $section['cards'][0];
              if ($firstCard['image'] && empty($firstCard['title']) && empty($firstCard['desc'])) {
                  $isHero = true;
              }
          }
          
          if (!$isHero) {
              foreach ($section['cards'] as $card) {
                  if ($card['image']) {
                      $hasImage = true;
                      break;
                  }
              }
          }
        @endphp

        @if ($isHero)
          <div class="safety-hero">
            <img src="{{ asset('storage/safety-riding/' . $section['cards'][0]['image']['value']) }}" alt="{{ $section['cards'][0]['image']['alt'] ?? 'Safety Riding' }}">
          </div>
        @else
          <h3 class="section-title text-center mt-5">{{ $section['nama'] }}</h3>
          
          @if ($hasImage)
            <div class="facility-grid">
              @foreach ($section['cards'] as $card)
                <div class="facility-card">
                  @if ($card['image'])
                    <img src="{{ asset('storage/safety-riding/' . $card['image']['value']) }}" alt="{{ $card['image']['alt'] ?? $card['title'] }}">
                  @else
                    <img src="https://dummyimage.com/600x400/000/fff" alt="{{ $card['title'] }}">
                  @endif
                  <div class="facility-content">
                    <h4>{{ $card['title'] }}</h4>
                    <p>{{ $card['desc'] }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <div class="safety-grid">
              @foreach ($section['cards'] as $card)
                <div class="safety-card">
                  <h3>{{ $card['title'] }}</h3>
                  <p>{{ $card['desc'] }}</p>
                </div>
              @endforeach
            </div>
          @endif
        @endif
      @endforeach
    @else
      <div class="safety-hero">
        <img src="https://dummyimage.com/600x400/000/fff" alt="Safety Riding">
      </div>

      <div class="safety-grid">
        <div class="safety-card">
          <h3>🪖 Gunakan Helm Standar</h3>
          <p>Selalu gunakan helm SNI untuk melindungi kepala dari cedera serius saat berkendara.</p>
        </div>
        <div class="safety-card">
          <h3>🚦 Patuhi Rambu Lalu Lintas</h3>
          <p>Ikuti semua aturan lalu lintas demi keselamatan diri sendiri dan pengguna jalan lain.</p>
        </div>
        <div class="safety-card">
          <h3>⚡ Jangan Ngebut</h3>
          <p>Berkendara dengan kecepatan aman untuk menghindari kecelakaan.</p>
        </div>
        <div class="safety-card">
          <h3>📱 Hindari Main HP</h3>
          <p>Fokus saat berkendara, jangan menggunakan ponsel di jalan.</p>
        </div>
        <div class="safety-card">
          <h3>🔧 Cek Kendaraan</h3>
          <p>Pastikan rem, lampu, dan ban dalam kondisi baik sebelum digunakan.</p>
        </div>
        <div class="safety-card">
          <h3>👕 Gunakan Perlengkapan</h3>
          <p>Pakai jaket, sarung tangan, dan sepatu untuk perlindungan tambahan.</p>
        </div>
      </div>

      <h3 class="section-title text-center mt-5">🏍️ Fasilitas Safety Riding</h3>
      <div class="facility-grid">
        <div class="facility-card">
          <img src="https://dummyimage.com/600x400/000/fff" alt="Area Praktik Berkendara">
          <div class="facility-content">
            <h4>Area Praktik Berkendara</h4>
            <p>Lapangan khusus untuk latihan berkendara yang aman dan terkontrol.</p>
          </div>
        </div>
        <div class="facility-card">
          <img src="https://dummyimage.com/600x400/000/fff" alt="Motor Latihan">
          <div class="facility-content">
            <h4>Motor Latihan</h4>
            <p>Kendaraan khusus yang digunakan siswa untuk praktik safety riding.</p>
          </div>
        </div>
        <div class="facility-card">
          <img src="https://dummyimage.com/600x400/000/fff" alt="Perlengkapan Safety">
          <div class="facility-content">
            <h4>Perlengkapan Safety</h4>
            <p>Helm, jaket, dan perlengkapan keselamatan lainnya tersedia untuk siswa.</p>
          </div>
        </div>
        <div class="facility-card">
          <img src="https://dummyimage.com/600x400/000/fff" alt="Instruktur Berpengalaman">
          <div class="facility-content">
            <h4>Instruktur Berpengalaman</h4>
            <p>Dibimbing oleh instruktur yang memahami standar keselamatan berkendara.</p>
          </div>
        </div>
      </div>
    @endif
  </div>
</section>
@endsection
