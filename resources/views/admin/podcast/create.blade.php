@extends('layouts.admin')

@section('title', 'Tambah Bagian Podcast')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Tambah Bagian Podcast</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.podcast.index') }}">Podcast</a></li>
            <li class="breadcrumb-item active">Tambah</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card card-primary shadow-sm">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-podcast mr-1"></i> Form Tambah Bagian — Podcast
              </h3>
            </div>

            <form action="{{ route('admin.podcast.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body">

                @if($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                  </div>
                @endif

                {{-- Nama Bagian --}}
                <div class="form-group">
                  <label>Nama Bagian <span class="text-danger">*</span></label>
                  <input type="text" name="nama_bagian" class="form-control"
                         value="{{ old('nama_bagian') }}" required
                         placeholder="Contoh: Deskripsi, Episode Terbaru, Cara Mendengarkan">
                  <small class="text-muted">Nama bagian akan tampil sebagai judul di halaman.</small>
                </div>

                {{-- Elemen Builder --}}
                <div class="form-group">
                  <label>Elemen Konten</label>
                  <small class="d-block text-muted mb-2">
                    Tambahkan elemen teks, gambar, atau link sesuai kebutuhan konten.
                  </small>

                  @include('admin._partials._elemen_builder', [
                    'existingElemen' => old('elemen_type') ? [] : [],
                    'folder'         => 'uploads/podcast',
                  ])
                </div>

              </div>

              <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.podcast.index') }}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save"></i> Simpan Bagian
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@push('scripts')
{{-- script ditangani oleh _elemen_builder.blade.php via @push --}}
@endpush
