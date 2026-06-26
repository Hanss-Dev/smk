@extends('layouts.app')

@section('title', 'Podcast - SMK Mitra Industri MM2100')

@section('content')
<section class="podcast-section">
  <div class="container">
    <div class="podcast-header text-center">
      <h2>🎧 Podcast SMK Mitra Industri MM2100</h2>
      <p>Media edukasi dan informasi melalui konten audio visual.</p>
    </div>

    <h3 class="section-title">🎬 Konten Podcast</h3>
    <div class="podcast-grid">
      <div class="podcast-card">
        <h4>Episode 1 - Dunia Industri</h4>
        <p>Skill yang harus kamu punya di 2026.</p>
        <div class="podcast-video">
          <iframe
            width="560"
            height="315"
            src="https://www.youtube.com/embed/3g4SP7QRnZY?si=l_FZop3YKGsukZ_y"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen>
          </iframe>
        </div>
      </div>

      <div class="podcast-card">
        <h4>Episode 2 - Tips Karir</h4>
        <p>Hari Bumi 2026: Our Power, Our Planet | Mitra Podcast ft. Ika Juliana (Ecoxyztem).</p>
        <div class="podcast-video">
          <iframe
            width="560"
            height="315"
            src="https://www.youtube.com/embed/ACkyQSVHEFs?si=_f0ErC26ZKdZK0Bf"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen>
          </iframe>
        </div>
      </div>
    </div>

    <h3 class="section-title mt-5">🎙️ Fasilitas Podcast</h3>
    <div class="facility-grid">
      <div class="facility-card">
        <h4>Studio Podcast</h4>
        <p>Ruang khusus dengan peredam suara untuk rekaman berkualitas.</p>
      </div>
      <div class="facility-card">
        <h4>Microphone Profesional</h4>
        <p>Menggunakan mic berkualitas tinggi untuk audio yang jernih.</p>
      </div>
      <div class="facility-card">
        <h4>Audio Mixer</h4>
        <p>Untuk mengatur kualitas suara dan mixing audio.</p>
      </div>
      <div class="facility-card">
        <h4>Editing Software</h4>
        <p>Digunakan untuk proses editing dan produksi podcast.</p>
      </div>
    </div>
  </div>
</section>
@endsection
