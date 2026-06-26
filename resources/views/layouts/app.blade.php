<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/berita.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/profil.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/tentang-kami.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/kontak.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/ppdb.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/skill.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/vision-mission.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/jurusan1.css') }}">

  <meta name="description" content="Website resmi SMK Mitra Industri MM2100 - Program Keahlian dan Kompetensi Industri">
  <link rel="icon" href="{{ asset('assets/img/logo-mt.png') }}" type="image/png">
  <title>@yield('title', 'SMK Mitra Industri MM2100')</title>
</head>

<body>
  <header class="header">
    <nav class="nav container">
      <div class="nav__data">
        <a href="{{ route('home') }}" class="nav__logo">
          <img src="{{ asset('assets/img/logo-mt.png') }}" alt="SMK MITRA INDUSTRI" />
        </a>

        <div class="nav__toggle" id="nav-toggle">
          <i class="ri-menu-line nav__burger"></i>
          <i class="ri-close-line nav__close"></i>
        </div>
      </div>

      <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">

          <li><a href="{{ route('home') }}" class="nav__link">Beranda</a></li>

          <li class="dropdown__item">
            <div class="nav__link">
              Profil <i class="ri-arrow-down-s-line dropdown__arrow"></i>
            </div>
            <ul class="dropdown__menu">
              <li><a href="{{ route('profile') }}" class="dropdown__link">Profil Sekolah</a></li>
              <li><a href="{{ route('visi-misi') }}" class="dropdown__link">Visi & Misi</a></li>
              <li>
                <a href="https://osismitraindustri.simdif.com/"
                  class="dropdown__link"
                  target="_blank">
                  Struktur OSIS
                </a>
              </li>
            </ul>
          </li>

          <li class="dropdown__item">
            <div class="nav__link">
              Kompetensi Keahlian <i class="ri-arrow-down-s-line dropdown__arrow"></i>
            </div>
            <ul class="dropdown__menu">
              <li><a href="{{ route('jurusan.titl') }}" class="dropdown__link">Teknik Instalasi Tenaga Listrik</a></li>
              <li><a href="{{ route('jurusan.tei') }}" class="dropdown__link">Teknik Elektronika Industri</a></li>
              <li><a href="{{ route('jurusan.tm') }}" class="dropdown__link">Teknik Mesin</a></li>
              <li><a href="{{ route('jurusan.tkro') }}" class="dropdown__link">Teknik Kendaraan Ringan Otomotif</a></li>
              <li><a href="{{ route('jurusan.tsm') }}" class="dropdown__link">Teknik Bisnis Sepeda Motor</a></li>
              <li><a href="{{ route('jurusan.tki') }}" class="dropdown__link">Teknik Kimia Industri</a></li>
              <li><a href="{{ route('jurusan.akuntansi') }}" class="dropdown__link">Akuntansi</a></li>
              <li><a href="{{ route('jurusan.perhotelan') }}" class="dropdown__link">Perhotelan</a></li>
            </ul>
          </li>

          <li class="dropdown__item">
            <div class="nav__link">
              Akademik <i class="ri-arrow-down-s-line dropdown__arrow"></i>
            </div>
            <ul class="dropdown__menu">
              <li><a href="{{ route('skill-passport') }}" class="dropdown__link">Skill Passport</a></li>
              <li><a href="https://tracersmk.polmind.ac.id" class="dropdown__link" target="_blank">Tracer Study</a></li>
            </ul>
          </li>

          <li class="dropdown__item">
            <div class="nav__link">
              Fasilitas <i class="ri-arrow-down-s-line dropdown__arrow"></i>
            </div>
            <ul class="dropdown__menu">
              <li><a href="{{ route('podcast') }}" class="dropdown__link">Podcast</a></li>
              <li><a href="{{ route('lab') }}" class="dropdown__link">Lab Komputer</a></li>
              <li><a href="{{ route('safety-riding') }}" class="dropdown__link">Safety Riding</a></li>
            </ul>
          </li>

          <li><a href="{{ route('ppdb') }}" class="nav__link">PPDB</a></li>

        </ul>
      </div>
    </nav>
  </header>

  @yield('content')

  <footer class="footer">
    <div class="footer-content">
      <div class="footer-column">
        <a href="{{ route('home') }}" class="logo" aria-label="SMK MITRA INDUSTRI">
          <img src="{{ asset('assets/img/logo-mt.png') }}" alt="SMK MITRA INDUSTRI" /><br />
        </a>
        <p>SMK Mitra Industri MM2100 adalah sekolah kejuruan unggulan yang berfokus pada pendidikan vokasi berkualitas dan kerjasama industri.</p>
        <div class="social-links">
          <a href="https://m.facebook.com/smkmitraindustri" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
          <a href="https://www.instagram.com/mitra_industri" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="https://youtube.com/@smkmitraindustrimmofficial" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
          <a href="https://www.tiktok.com/@mitra_industri" aria-label="Tiktok"><i class="fab fa-tiktok"></i></a>
        </div>
      </div>

      <div class="footer-column">
        <h3>Kompetensi Keahlian</h3>
        <ul class="footer-links">
          <li><a href="{{ route('jurusan.titl') }}">Teknik Instalasi Tenaga Listrik</a></li>
          <li><a href="{{ route('jurusan.tei') }}">Teknik Elektronika Industri</a></li>
          <li><a href="{{ route('jurusan.tm') }}">Teknik Mesin</a></li>
          <li><a href="{{ route('jurusan.tkro') }}">Teknik Kendaraan Ringan Otomotif</a></li>
          <li><a href="{{ route('jurusan.tsm') }}">Teknik Bisnis Sepeda Motor</a></li>
          <li><a href="{{ route('jurusan.tki') }}">Teknik Kimia Industri</a></li>
          <li><a href="{{ route('jurusan.akuntansi') }}">Akuntansi</a></li>
          <li><a href="{{ route('jurusan.perhotelan') }}">Perhotelan</a></li>
        </ul>
      </div>

      <div class="footer-column">
        <h3>Link Penting</h3>
        <ul class="footer-links">
          <li><a href="{{ route('ppdb') }}">PPDB Online</a></li>
          <li><a href="#">Portal Siswa</a></li>
          <li><a href="{{ route('news.index') }}">Artikel &amp; Berita</a></li>
        </ul>
      </div>

      <div class="footer-column">
        <h3>Kontak</h3>
        <ul class="footer-links">
          <li>
            <a href="https://maps.app.goo.gl/EUWQcZ1E81KyoToR8">
              Kawasan Industri MM2100,<br />
              Cikarang Barat,<br />
              Bekasi Barat 17530
            </a>
          </li>
          <li>
            <strong>Telepon:</strong> (021) 8998-3961<br />
            <strong>Email:</strong> smkmitraindustrimm2100<br/>@smkind-mm2100.sch.id
          </li>
        </ul>
      </div>
    </div>

    <div class="copyright text-center">
      <p>
        © SMK Mitra Industri MM2100 — All Rights Reserved
      </p>
      <p class="credits">
        Made by <a href="https://polmind.ac.id" target="_blank">Politeknik Mitra Industri</a> 
        & Team <strong>Nusantara Cakrawala</strong>
      </p>
    </div>
  </footer>

  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @yield('scripts')
</body>

</html>
