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
