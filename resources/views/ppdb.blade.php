@extends('layouts.app')

@section('title', 'PPDB Online - SMK Mitra Industri MM2100')

@section('content')
<section id="ppdb">
  <div class="ppdb-bg"></div>
  <div class="ppdb-container">
    <div class="ppdb-header">
      <h2>Pendaftaran Peserta Didik Baru</h2>
      <div class="ppdb-divider"></div>
      <p>Bergabunglah dengan SMK Mitra Industri dan wujudkan masa depan cemerlang Anda</p>
    </div>

    <div class="ppdb-grid">
      <div class="ppdb-box">
        <h3>Persyaratan Pendaftaran</h3>
        <ul>
          <li>✔ Lulus SMP/MTs atau sederajat</li>
          <li>✔ Fotocopy ijazah/SKHUN legalisir (2 lembar)</li>
          <li>✔ Fotocopy Kartu Keluarga (2 lembar)</li>
          <li>✔ Fotocopy Akta Kelahiran (1 lembar)</li>
          <li>✔ Pas foto 3x4 (4 lembar) background merah</li>
          <li>✔ Fotocopy KTP orang tua (1 lembar)</li>
          <li>✔ Surat keterangan sehat dari dokter</li>
          <li>✔ Surat keterangan kelakuan baik dari sekolah asal</li>
        </ul>
      </div>

      <div class="ppdb-box">
        <h3>Alur Pendaftaran</h3>
        <div class="ppdb-step">
          <div class="step-number">1</div>
          <div>
            <h4>Pendaftaran Online</h4>
            <p>Isi formulir pendaftaran online melalui website resmi</p>
          </div>
        </div>
        <div class="ppdb-step">
          <div class="step-number">2</div>
          <div>
            <h4>Verifikasi Berkas</h4>
            <p>Upload dokumen persyaratan dan tunggu verifikasi panitia</p>
          </div>
        </div>
        <div class="ppdb-step">
          <div class="step-number">3</div>
          <div>
            <h4>Tes Seleksi</h4>
            <p>Mengikuti tes tertulis dan wawancara sesuai jadwal</p>
          </div>
        </div>
        <div class="ppdb-step">
          <div class="step-number">4</div>
          <div>
            <h4>Pengumuman</h4>
            <p>Pengumuman hasil seleksi melalui website dan SMS</p>
          </div>
        </div>
        <div class="ppdb-step">
          <div class="step-number">5</div>
          <div>
            <h4>Daftar Ulang</h4>
            <p>Melakukan daftar ulang dengan membawa berkas asli</p>
          </div>
        </div>
      </div>
    </div>
    <div class="daftarSekarang">
      <a href="https://userppdb.smkind-mm2100.sch.id/login" target="_blank">Daftar Sekarang</a>
    </div>
  </div>
</section>
@endsection
