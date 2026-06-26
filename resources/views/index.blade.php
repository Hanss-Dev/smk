@extends('layouts.app')

@section('title', 'Beranda - SMK Mitra Industri MM2100')

@section('content')
<main>
  <div class="hero-new">
    <video autoplay loop muted playsinline src="{{ asset('assets/video/videoherooo.mp4') }}"></video>
    <h5>SELAMAT DATANG DI</h5>
    <h1>SMK MITRA INDUSTRI<br>MM2100</h1>
  </div>

  <section class="nilai-utama">
    <h2>5 Nilai Utama</h2>
    <div class="nilai-grid">
      <div class="nilai-item">
        <img src="{{ asset('assets/img/LIMA-NILAI/jujur.png') }}" alt="Jujur" />
        <p>Jujur</p>
      </div>
      <div class="nilai-item">
        <img src="{{ asset('assets/img/LIMA-NILAI/tanggungjawab.png') }}" alt="Tanggung Jawab" />
        <p>Tanggung Jawab</p>
      </div>
      <div class="nilai-item">
        <img src="{{ asset('assets/img/LIMA-NILAI/displin.png') }}" alt="Disiplin" />
        <p>Disiplin</p>
      </div>
      <div class="nilai-item">
        <img src="{{ asset('assets/img/LIMA-NILAI/kerjasama.png') }}" alt="Kerja Sama" />
        <p>Kerja Sama</p>
      </div>
      <div class="nilai-item">
        <img src="{{ asset('assets/img/LIMA-NILAI/peduli.png') }}" alt="Peduli" />
        <p>Peduli</p>
      </div>
    </div>
  </section>

  <section class="smi-heroLite">
    <div class="smi-heroLite__wrap">
      <div class="smi-heroLite__left">
        <span class="smi-badge">SMK Unggulan Industri</span>
        <h2>Mengapa Memilih SMK Mitra Industri MM2100?</h2>
        <p>Pembelajaran berbasis industri, karakter kuat, dan kesiapan kerja nyata untuk masa depan.</p>
        <a href="#program" class="smi-btn">🚀 Lihat Program</a>
      </div>

      <div class="smi-liteSlider">
        <button class="smi-liteBtn prev" aria-label="Sebelumnya">
          <svg viewBox="0 0 24 24"><path d="M15 18L9 12L15 6"/></svg>
        </button>

        <div class="smi-liteViewport">
          <div class="smi-liteTrack">
            <article class="smi-liteSlide">
              <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800" alt="Diprakarsai Praktisi HRD Industri">
              <div class="smi-slideOverlay"></div>
              <h3>Diprakarsai Praktisi HRD Industri</h3>
            </article>
            <article class="smi-liteSlide">
              <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=800" alt="Kawasan Industri MM2100">
              <div class="smi-slideOverlay"></div>
              <h3>Kawasan Industri MM2100</h3>
            </article>
            <article class="smi-liteSlide">
              <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800" alt="Sistem Link Match">
              <div class="smi-slideOverlay"></div>
              <h3>Sistem Terpadu Link & Match</h3>
            </article>
            <article class="smi-liteSlide">
              <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?w=800" alt="Budaya Industri">
              <div class="smi-slideOverlay"></div>
              <h3>Menerapkan Budaya Industri</h3>
            </article>
            <article class="smi-liteSlide">
              <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=800" alt="Kerja Sama Industri">
              <div class="smi-slideOverlay"></div>
              <h3>Kerja Sama Sekolah, Kampus & Industri</h3>
            </article>
          </div>
        </div>

        <button class="smi-liteBtn next" aria-label="Berikutnya">
          <svg viewBox="0 0 24 24"><path d="M9 6L15 12L9 18"/></svg>
        </button>

        <div class="smi-liteDots"></div>
      </div>
    </div>
  </section>

  <section class="alumni-success">
    <div class="alumni-container">
      <div class="alumni-header">
        <h2>Jejak Kesuksesan Alumni</h2>
        <p>Alumni SMK Mitra Industri MM2100 telah berkiprah di berbagai sektor industri, baik di dalam maupun luar negeri.</p>
      </div>

      <div class="alumni-grid">
        <article class="alumni-card">
          <div class="alumni-photo">
            <img src="https://dummyimage.com/600x400/000/fff" alt="Alumni Industri Jepang">
            <span class="alumni-badge">🌍 Jepang</span>
          </div>
          <div class="alumni-info">
            <h3>Alumni Teknik Mesin</h3>
            <p class="alumni-role">Operator CNC</p>
            <p class="alumni-company">Manufaktur Otomotif Jepang</p>
          </div>
        </article>

        <article class="alumni-card">
          <div class="alumni-photo">
            <img src="https://dummyimage.com/600x400/000/fff" alt="Alumni Industri Nasional">
            <span class="alumni-badge">🇮🇩 Indonesia</span>
          </div>
          <div class="alumni-info">
            <h3>Alumni TEI</h3>
            <p class="alumni-role">Teknisi Otomasi</p>
            <p class="alumni-company">Industri Elektronik Nasional</p>
          </div>
        </article>

        <article class="alumni-card">
          <div class="alumni-photo">
            <img src="https://dummyimage.com/600x400/000/fff" alt="Alumni Hospitality">
            <span class="alumni-badge">🌍 Timur Tengah</span>
          </div>
          <div class="alumni-info">
            <h3>Alumni Perhotelan</h3>
            <p class="alumni-role">Hotel Service Staff</p>
            <p class="alumni-company">Hotel Internasional</p>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="school-banner">
    <div class="banner-overlay">
      <h1>SMK Mitra Industri MM2100</h1>
      <p>The Real Vokasional School</p>
    </div>
  </section>

  <section id="network">
    <div class="network-container">
      <div class="network-header">
        <h2>Jaringan Cabang & Afiliasi</h2>
        <div class="network-divider"></div>
        <p class="network-subtitle">Jejaring sekolah dan mitra industri untuk mendukung ekosistem pendidikan dan karier siswa.</p>
      </div>

      <div class="network-tabs" aria-label="Filter">
        <button class="tab active" data-filter="all">Semua</button>
        <button class="tab" data-filter="cabang">Cabang</button>
        <button class="tab" data-filter="afiliasi">Afiliasi</button>
      </div>

      <div class="network-grid">
        <article class="network-card" data-type="cabang">
          <div class="card-header">
            <div class="logo-affiliasi">
              <img src="https://smkind-mm2100.sch.id/wp-content/uploads/2024/12/babelan.jpg" alt="SMK 1 Babelan Kabupaten - Bekasi">
            </div>
            <div class="card-meta">
              <h3>SMK 1 Babelan Kabupaten - Bekasi</h3>
              <span class="badge badge-branch">Cabang</span>
            </div>
          </div>
          <p class="card-desc">SMK 1 Babelan Kabupaten Bekasi adalah sekolah afiliasi kerjasama pendampingan Program <i>Link & Match</i> PT Cikarang Listrindo, Tbk PLTU Babelan dan supervisi dengan SMK Mitra Industri MM2100</p>
          <div class="card-actions">
            <a class="btn btn-primary" href="#" target="_blank" rel="noopener">Kunjungi Website</a>
            <a class="btn btn-outline" href="https://www.google.com/maps/place/SMK+Mitra+Industri+MM2100/@-6.2986756,107.1017057,17z" target="_blank" rel="noopener">Buka Maps</a>
          </div>
        </article>

        <article class="network-card" data-type="cabang">
          <div class="card-header">
            <div class="logo-affiliasi">
              <img src="https://smkind-mm2100.sch.id/wp-content/uploads/2024/12/smk-mitra-03.jpg" alt="SMK Mitra Industri 03 Kampus - Putradarma">
            </div>
            <div class="card-meta">
              <h3>SMK Mitra Industri 03 Kampus - Putradarma</h3>
              <span class="badge badge-branch">Cabang</span>
            </div>
          </div>
          <p class="card-desc">SMK Mitra industri Kampus Putradarma adalah cabang dari SMK Mitra Industri MM2100</p>
          <div class="card-actions">
            <a class="btn btn-primary" href="#" target="_blank" rel="noopener">Kunjungi Website</a>
            <a class="btn btn-outline" href="#" target="_blank" rel="noopener">Buka Maps</a>
          </div>
        </article>

        <article class="network-card" data-type="afiliasi">
          <div class="card-header">
            <div class="logo-affiliasi">
              <img src="https://smkind-mm2100.sch.id/wp-content/uploads/2024/11/tes.png" alt="SMK Mitra Industri 02 - Pati">
            </div>
            <div class="card-meta">
              <h3>SMK Mitra Industri 02 - Pati</h3>
              <span class="badge badge-affiliate">Afiliasi</span>
            </div>
          </div>
          <p class="card-desc">SMK Mitra industri 02 Pati adalah sekolah cabang dari SMK Mitra Industri MM2100 yang berlokasi di Sendangrejo RT.05 RW.01, Sendangrejo, Kec. Tayu, Kab. Pati Prov. Jawa Tengah</p>
          <div class="card-actions">
            <a class="btn btn-primary" href="https://smkmitraindustri02.sch.id/" target="_blank" rel="noopener">Kunjungi Website</a>
            <a class="btn btn-outline" href="#" target="_blank" rel="noopener">Buka Maps</a>
          </div>
        </article>

        <article class="network-card" data-type="afiliasi">
          <div class="card-header">
            <div class="logo-affiliasi">
              <img src="https://smkind-mm2100.sch.id/wp-content/uploads/2024/12/klaten.jpg" alt="SMK Kristen 2 Klaten">
            </div>
            <div class="card-meta">
              <h3>SMK Kristen 2 Klaten</h3>
              <span class="badge badge-affiliate">Afiliasi</span>
            </div>
          </div>
          <p class="card-desc">SMK Kristen 2 Klaten adalah sekolah afiliasi kerjasama sistem dan supervisi dengan SMK Mitra Industri MM2100</p>
          <div class="card-actions">
            <a class="btn btn-primary" href="#" target="_blank" rel="noopener">Profil Mitra</a>
            <a class="btn btn-outline" href="#" target="_blank" rel="noopener">MoU / Berita</a>
          </div>
        </article>
          
        <article class="network-card" data-type="afiliasi">
          <div class="card-header">
            <div class="logo-affiliasi">
              <img src="https://smkind-mm2100.sch.id/wp-content/uploads/2024/12/stela-maris.jpg" alt="SMK Stella Maris Labuan Bajo">
            </div>
            <div class="card-meta">
              <h3>SMK Stella Maris Labuan Bajo</h3>
              <span class="badge badge-affiliate">Afiliasi</span>
            </div>
          </div>
          <p class="card-desc">SMK Stella Maris Labuan Bajo adalah sekolah afiliasi kerjasama sistem dan supervisi dengan SMK Mitra Industri MM2100</p>
          <div class="card-actions">
            <a class="btn btn-primary" href="#" target="_blank" rel="noopener">Kunjungi Website</a>
            <a class="btn btn-outline" href="#" target="_blank" rel="noopener">MoU / Berita</a>
          </div>
        </article>
          
        <article class="network-card" data-type="afiliasi">
          <div class="card-header">
            <div class="logo-affiliasi">
              <img src="https://smkind-mm2100.sch.id/wp-content/uploads/2024/12/smk-ananda-deltamas.png" alt="SMK Ananda Mitra Industri Deltamas">
            </div>
            <div class="card-meta">
              <h3>SMK Ananda Mitra Industri Deltamas</h3>   
              <span class="badge badge-affiliate">Afiliasi</span>
            </div>
          </div>
          <p class="card-desc">SMK Ananda Mitra Industri Deltamas adalah sekolah afiliasi kerjasama brand dan supervisi.</p>
          <div class="card-actions">
            <a class="btn btn-primary" href="#" target="_blank" rel="noopener">Kunjungi Website</a>
            <a class="btn btn-outline" href="#" target="_blank" rel="noopener">MoU / Berita</a>
          </div>
        </article>
          
        <article class="network-card" data-type="afiliasi">
          <div class="card-header">
            <div class="logo-affiliasi">
              <img src="https://smkind-mm2100.sch.id/wp-content/uploads/2024/12/smk-asyarif-885x1024.png" alt="SMK Asy-Syarif Mitra Industri Mojokerto">
            </div>
            <div class="card-meta">
              <h3>SMK Asy-Syarif Mitra Industri Mojokerto</h3>   
              <span class="badge badge-affiliate">Cabang</span>
            </div>
          </div>
          <p class="card-desc">SMK Asy-Syarif Mitra Industri Mojokerto adalah sekolah yang bekerjasama secara operasional dan brand dengan SMK Mitra Industri MM2100.</p>
          <div class="card-actions">
            <a class="btn btn-primary" href="#" target="_blank" rel="noopener">Kunjungi Website</a>
            <a class="btn btn-outline" href="#" target="_blank" rel="noopener">MoU / Berita</a>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="card-carousel-section">
    <div class="card-carousel-container">
      <div class="berita-header">
        <h2>Highlight SMK Mitra Industri MM2100</h2>
        <div class="berita-divider"></div>
      </div>

      <article class="card-carousel-item">
        <a href="https://smkind-mm2100.sch.id/october-digital-creativity/" class="card-image" target="_blank">
          <img src="{{ asset('assets/img/odc.png') }}" alt="INFORMASI ODC 2025" />
        </a>
        <div class="card-content">
          <h3 class="card-title">INFORMASI ODC (OCTOBER DIGITAL CREATIVITY) 2025</h3>
          <a href="https://smkind-mm2100.sch.id/october-digital-creativity/" class="card-btn" target="_blank">Show More</a>
        </div>
      </article>
    </div>
  </section>

  <section class="highlight-section">
    <div class="highlight-container">
      @foreach ($highlights as $h)
        <article class="highlight-item">
          <div class="highlight-image">
            <img src="{{ asset('uploads/highlight/' . $h->image) }}" alt="{{ $h->title }}">
          </div>
          <div class="highlight-text">
            <h2 class="highlight-title">{{ $h->title }}</h2>
            <p class="highlight-desc">{!! nl2br(e($h->description)) !!}</p>
          </div>
        </article>
      @endforeach
    </div>
  </section>

  <section id="berita">
    <div class="berita-container">
      <div class="berita-header">
        <h2>Berita SMK Mitra Industri MM2100</h2>
        <div class="berita-divider"></div>
      </div>

      <div class="berita-slider">
        @forelse ($news as $n)
          <div class="berita-card">
            <div class="berita-image">
              @if ($n->thumbnail)
                <img src="{{ asset('uploads/news/' . $n->thumbnail) }}" alt="{{ $n->title }}">
              @endif
            </div>
            <div class="berita-content">
              <div class="berita-date">{{ $n->created_at ? $n->created_at->format('d F Y') : '' }}</div>
              <h3>{{ $n->title }}</h3>
              <p class="berita-desc">{{ Str::limit(strip_tags($n->content), 140) }}...</p>
              <a href="{{ route('news.show', $n->slug) }}" class="berita-btn">Baca Selengkapnya</a>
            </div>
          </div>
        @empty
          <p>Belum ada berita.</p>
        @endforelse
      </div>

      <div class="slider-nav">
        <button id="prevBtn" aria-label="Sebelumnya">&#10094;</button>
        <button id="nextBtn" aria-label="Berikutnya">&#10095;</button>
      </div>
    </div>
  </section>

  <section class="yuko-sldr" id="program">
    <div class="yuko-sldr-bg"></div>
    <div class="yuko-container">
      <div class="yuko-slider">
        <div class="yuko-item active" data-bg="{{ asset('assets/img/LISTRIK/LISTRIK.jpg') }}">
          <img data-src="{{ asset('assets/img/LISTRIK/LISTRIK.jpg') }}">
        </div>
        <div class="yuko-item" data-bg="{{ asset('assets/img/ELIND/ELIND-IC.jpg') }}">
          <img data-src="{{ asset('assets/img/ELIND/ELIND-IC.jpg') }}">
        </div>
        <div class="yuko-item" data-bg="{{ asset('assets/img/MESIN/MESIN.jpg') }}">
          <img data-src="{{ asset('assets/img/MESIN/MESIN.jpg') }}">
        </div>
        <div class="yuko-item" data-bg="{{ asset('assets/img/TKR/TKR.jpg') }}">
          <img data-src="{{ asset('assets/img/TKR/TKR.jpg') }}">
        </div>
        <div class="yuko-item" data-bg="{{ asset('assets/img/TSM/TSM.jpg') }}">
          <img data-src="{{ asset('assets/img/TSM/TSM.jpg') }}">
        </div>
        <div class="yuko-item" data-bg="{{ asset('assets/img/TKI/TKI.jpg') }}">
          <img data-src="{{ asset('assets/img/TKI/TKI.jpg') }}">
        </div>
        <div class="yuko-item" data-bg="{{ asset('assets/img/AKUNTANSI/AKUNTANSI.jpg') }}">
          <img data-src="{{ asset('assets/img/AKUNTANSI/AKUNTANSI.jpg') }}">
        </div>
        <div class="yuko-item" data-bg="{{ asset('assets/img/HOTEL/HOTEL.jpg') }}">
          <img data-src="{{ asset('assets/img/HOTEL/HOTEL.jpg') }}">
        </div>
      </div>

      <div class="yuko-content">
        <div class="yuko-content-item active">
          <h2>Teknik Instalasi Tenaga Listrik</h2>
          <p>Kompetensi instalasi listrik bangunan dan industri.</p>
          <a href="{{ route('jurusan.titl') }}" class="yuko-button">Selengkapnya</a>
        </div>
        <div class="yuko-content-item">
          <h2>Teknik Elektronika Industri</h2>
          <p>PLC, sensor industri, dan otomasi mesin.</p>
          <a href="{{ route('jurusan.tei') }}" class="yuko-button">Selengkapnya</a>
        </div>
        <div class="yuko-content-item">
          <h2>Teknik Mesin</h2>
          <p>Manufaktur, CNC, dan teknik pengelasan.</p>
          <a href="{{ route('jurusan.tm') }}" class="yuko-button">Selengkapnya</a>
        </div>
        <div class="yuko-content-item">
          <h2>TKR</h2>
          <p>Perawatan dan perbaikan kendaraan ringan.</p>
          <a href="{{ route('jurusan.tkro') }}" class="yuko-button">Selengkapnya</a>
        </div>
        <div class="yuko-content-item">
          <h2>TSM</h2>
          <p>Servis sepeda motor dan manajemen bengkel.</p>
          <a href="{{ route('jurusan.tsm') }}" class="yuko-button">Selengkapnya</a>
        </div>
        <div class="yuko-content-item">
          <h2>Teknik Kimia Industri</h2>
          <p>Proses produksi dan pengendalian mutu.</p>
          <a href="{{ route('jurusan.tki') }}" class="yuko-button">Selengkapnya</a>
        </div>
        <div class="yuko-content-item">
          <h2>Akuntansi</h2>
          <p>Pembukuan dan laporan keuangan.</p>
          <a href="{{ route('jurusan.akuntansi') }}" class="yuko-button">Selengkapnya</a>
        </div>
        <div class="yuko-content-item">
          <h2>Perhotelan</h2>
          <p>Front office, housekeeping, dan layanan hotel.</p>
          <a href="{{ route('jurusan.perhotelan') }}" class="yuko-button">Selengkapnya</a>
        </div>
      </div>
    </div>

    <div class="yuko-nav">
      <button id="prev">‹</button>
      <div class="yuko-dots"></div>
      <button id="next">›</button>
    </div>
  </section>

  @if ($popup)
    <div id="ppdb-popup" class="popup show">
      <div class="popup-content">
        <div class="popup-body">
          @if ($popup->image)
            <a href="{{ route('ppdb') }}">
              <img src="{{ asset('uploads/popup/' . $popup->image) }}" alt="{{ $popup->title }}">
            </a>
          @endif

          <div class="column content">
            <h2>{{ $popup->title }}</h2>
            <p class="paragrafPopup">{!! nl2br(e($popup->content)) !!}</p>

            <div class="button-group">
              <a href="https://userppdb.smkind-mm2100.sch.id/login" class="btn-brosur" target="_blank">
                <i class="fas fa-sign-in-alt"></i> Buat Akun / Masuk
              </a>
              <a href="https://drive.google.com/file/d/154JHaNtV1gMEqchlTXUv2Xjqr5rDq-7x/view?usp=drive_link" class="btn-brosur" target="_blank">
                <i class="far fa-edit"></i> Cara Pembuatan Akun
              </a>
              <a href="https://drive.google.com/file/d/1MQwd3QXXZzhPmGTIWqO_r0fjQavK4C1U/view?usp=sharing" class="btn-brosur" target="_blank">
                <i class="far fa-newspaper"></i> Brosur PMB 2026/2027
              </a>
              <a href="https://smkind-mm2100.sch.id/ppdb/" class="btn-brosur" target="_blank">
                <i class="fas fa-info-circle"></i> Informasi PMB
              </a>
            </div>
          </div>
        </div>
        <button type="button" class="close-btn">×</button>
      </div>
    </div>
  @endif

  <section class="vt-astra">
    <div class="vt-content">
      <h2>3D Virtual<br />Tour Sekolah</h2>
      <p>Bersiaplah untuk memulai perjalanan visual yang menarik! Temukan keindahan arsitektur modern dan ruang belajar inovatif.</p>
      <a href="https://virtual-tour-livid.vercel.app/" target="_blank" class="vt-btn">Tour</a>
    </div>

    <div class="vt-visual">
      <img src="{{ asset('assets/img/figuran3d.png') }}" class="vt-vr" alt="3D Virtual Tour Sekolah" />
      <img src="{{ asset('assets/img/Gedung.png') }}" class="vt-bg" alt="3D Virtual Tour Sekolah" />
    </div>
  </section>

  <section class="mm2100-support">
    <h2>Didukung oleh Perusahaan Kawasan Industri MM2100</h2>
    <div class="image-wrapper">
      <img src="{{ asset('assets/img/mm2100-companies.png') }}" alt="Logo Perusahaan MM2100" />
    </div>
  </section>

  <section class="comment-section">
    <h2>Message</h2>
    <div class="divider"></div>

    <div class="row">
      <div class="col contact-info">
        <ul>
          <li><i class="fas fa-map-marker-alt"></i> Kawasan Industri MM2100, Cikarang Barat</li>
          <li><i class="fas fa-phone"></i> (021) 8998-3961</li>
          <li><i class="fas fa-envelope"></i> smkmitraindustrimm2100@smkind-mm2100.sch.id</li>
        </ul>
      </div>

      <div class="col">
        <form action="{{ route('contact.store') }}" method="post">
          @csrf
          <input type="text" name="name" placeholder="Nama Anda..." value="{{ old('name') }}" required>
          <input type="email" name="email" placeholder="Email Anda..." value="{{ old('email') }}" required>
          <input type="text" name="telepon" placeholder="Nomor Telepon..." value="{{ old('telepon') }}" required>
          <textarea id="msg" name="message" rows="4" maxlength="500" placeholder="Tulis pesan..." required>{{ old('message') }}</textarea>
          <small id="counter">0 / 500</small>
          <button type="submit">Kirim</button>
        </form>
      </div>
    </div>
  </section>
</main>
@endsection

@section('scripts')
@if(request()->query('success'))
<script>
document.addEventListener("DOMContentLoaded", function() {
  Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: 'Pesan berhasil dikirim!',
    confirmButtonColor: '#3085d6'
  });
});
</script>
@endif

@if(request()->query('error'))
<script>
document.addEventListener("DOMContentLoaded", function() {
  Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: '{{
      request()->query("error") == 1 ? "Semua field wajib diisi!" :
      (request()->query("error") == 2 ? "Email tidak valid!" :
      (request()->query("error") == 3 ? "Nomor telepon tidak valid!" : "Terjadi kesalahan!"))
    }}'
  });
});
</script>
@endif
@endsection
