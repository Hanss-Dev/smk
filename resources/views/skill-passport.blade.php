@extends('layouts.app')

@section('title', 'Skill Passport - SMK Mitra Industri MM2100')

@section('content')
<main>
  <section class="skill-passport">
    <div class="skill-container">
      <div class="skill-header">
        <h2>Skill Passport Siswa</h2>
        <p>
          Setiap lulusan SMK Mitra Industri MM2100 dibekali Skill Passport sebagai
          bukti kompetensi, karakter, dan kesiapan kerja di dunia industri nasional
          maupun internasional.
        </p>
      </div>

      <div class="skill-grid">
        <div class="skill-card">
          <div class="skill-icon">🛠️</div>
          <h3>Hard Skill Industri</h3>
          <p>
            Kompetensi teknis sesuai jurusan dan standar industri,
            mulai dari mesin, listrik, elektronika, hingga hospitality.
          </p>
        </div>

        <div class="skill-card">
          <div class="skill-icon">🤝</div>
          <h3>Soft Skill Profesional</h3>
          <p>
            Disiplin, tanggung jawab, kerja sama tim, komunikasi,
            dan etika kerja industri.
          </p>
        </div>

        <div class="skill-card">
          <div class="skill-icon">📄</div>
          <h3>Sertifikasi & Portofolio</h3>
          <p>
            Sertifikat kompetensi, PKL industri, serta portofolio
            hasil praktik dan proyek siswa.
          </p>
        </div>

        <div class="skill-card">
          <div class="skill-icon">🌍</div>
          <h3>Kesiapan Global</h3>
          <p>
            Pembekalan budaya kerja, keselamatan kerja,
            dan standar industri internasional.
          </p>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
