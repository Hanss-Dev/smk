@extends('layouts.app')

@section('title', 'Podcast - SMK Mitra Industri MM2100')

@section('content')
<section class="podcast-section">
  <div class="container">
    <div class="podcast-header text-center">
      <h2>🎧 Podcast SMK Mitra Industri MM2100</h2>
      <p>Media edukasi dan informasi melalui konten audio visual.</p>
    </div>

    @if (!empty($sections))
      @foreach ($sections as $section)
        <h3 class="section-title mt-5">{{ $section['nama'] }}</h3>
        
        @php
          $hasVideo = false;
          foreach ($section['cards'] as $card) {
              if ($card['link'] && (str_contains($card['link']['value'], 'youtube.com') || str_contains($card['link']['value'], 'youtu.be') || str_contains($card['link']['value'], 'embed'))) {
                  $hasVideo = true;
                  break;
              }
          }
        @endphp

        @if ($hasVideo)
          <div class="podcast-grid">
            @foreach ($section['cards'] as $card)
              <div class="podcast-card">
                <h4>{{ $card['title'] }}</h4>
                @if ($card['desc'])
                  <p>{{ $card['desc'] }}</p>
                @endif
                @if ($card['link'])
                  @php
                    $url = $card['link']['value'];
                    if (str_contains($url, 'watch?v=')) {
                        $url = str_replace('watch?v=', 'embed/', $url);
                    } elseif (str_contains($url, 'youtu.be/')) {
                        $parts = explode('youtu.be/', $url);
                        $url = 'https://www.youtube.com/embed/' . end($parts);
                    }
                  @endphp
                  <div class="podcast-video">
                    <iframe
                      width="560"
                      height="315"
                      src="{{ $url }}"
                      title="{{ $card['title'] }}"
                      frameborder="0"
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                      referrerpolicy="strict-origin-when-cross-origin"
                      allowfullscreen>
                    </iframe>
                  </div>
                @endif
              </div>
            @endforeach
          </div>
        @else
          <div class="facility-grid">
            @foreach ($section['cards'] as $card)
              <div class="facility-card">
                <h4>{{ $card['title'] }}</h4>
                <p>{{ $card['desc'] }}</p>
              </div>
            @endforeach
          </div>
        @endif
      @endforeach
    @else
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
    @endif
  </div>
</section>
@endsection
