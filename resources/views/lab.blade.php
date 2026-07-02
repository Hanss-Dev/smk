@extends('layouts.app')

@section('title', 'Laboratorium Komputer - SMK Mitra Industri MM2100')

@section('content')
<section class="lab-section">
  <div class="container">
    <div class="lab-header text-center">
      <h2>💻 Laboratorium Komputer</h2>
      <p>Fasilitas modern untuk mendukung pembelajaran teknologi di SMK Mitra Industri MM2100.</p>
    </div>

    @if (!empty($sections))
      @foreach ($sections as $section)
        <h3 class="section-title text-center mt-5">{{ $section['nama'] }}</h3>
        <div class="lab-grid">
          @foreach ($section['cards'] as $card)
            <div class="lab-card">
              @if ($card['image'])
                <img src="{{ asset('storage/lab-komputer/' . $card['image']['value']) }}" alt="{{ $card['image']['alt'] ?? $card['title'] }}">
              @else
                <img src="https://dummyimage.com/600x400/000/fff" alt="{{ $card['title'] }}">
              @endif
              <div class="lab-content">
                <h3>{{ $card['title'] }}</h3>
                <p>{{ $card['desc'] }}</p>
                
                @if (!empty($card['extra_texts']))
                  <ul>
                    @foreach ($card['extra_texts'] as $txt)
                      <li>✔️ {{ $txt }}</li>
                    @endforeach
                  </ul>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      @endforeach
    @else
      <div class="lab-grid">
        <div class="lab-card">
          <img src="https://dummyimage.com/600x400/000/fff" alt="Lab Komputer">
          <div class="lab-content">
            <h3>Lab Programming</h3>
            <p>Digunakan untuk pembelajaran coding seperti HTML, CSS, JavaScript, dan bahasa pemrograman lainnya.</p>
            <ul>
              <li>✔️ 40 Unit PC</li>
              <li>✔️ Internet Cepat</li>
              <li>✔️ Proyektor</li>
            </ul>
          </div>
        </div>

        <div class="lab-card">
          <img src="https://dummyimage.com/600x400/000/fff" alt="Lab Multimedia">
          <div class="lab-content">
            <h3>Lab Multimedia</h3>
            <p>Fokus pada desain grafis, editing video, dan pengembangan konten digital.</p>
            <ul>
              <li>✔️ Software Adobe</li>
              <li>✔️ Audio & Video Editing</li>
              <li>✔️ Rendering PC</li>
            </ul>
          </div>
        </div>

        <div class="lab-card">
          <img src="https://dummyimage.com/600x400/000/fff" alt="Lab Jaringan">
          <div class="lab-content">
            <h3>Lab Jaringan</h3>
            <p>Tempat praktik konfigurasi jaringan komputer dan server.</p>
            <ul>
              <li>✔️ Router & Switch</li>
              <li>✔️ Simulasi Server</li>
              <li>✔️ Cisco Lab</li>
            </ul>
          </div>
        </div>
      </div>
    @endif
  </div>
</section>
@endsection
