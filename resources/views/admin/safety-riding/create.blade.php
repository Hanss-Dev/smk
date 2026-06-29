@extends('layouts.admin')

@section('title', 'Tambah Bagian Safety Riding')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Tambah Bagian Safety Riding</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.safety-riding.index') }}">Safety Riding</a></li>
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
                <i class="fas fa-motorcycle mr-1"></i> Form Tambah Bagian — Safety Riding
              </h3>
            </div>

            <form action="{{ route('admin.safety-riding.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body">

                @if($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                  </div>
                @endif

                <div class="form-group">
                  <label>Nama Bagian <span class="text-danger">*</span></label>
                  <input type="text" name="nama_bagian" class="form-control"
                         value="{{ old('nama_bagian') }}" required
                         placeholder="Contoh: Gunakan Helm Standar, Fasilitas Praktik, Instruktur">
                  <small class="text-muted">Nama bagian akan tampil sebagai judul di halaman.</small>
                </div>

                <div class="form-group">
                  <label>Elemen Konten</label>
                  <small class="d-block text-muted mb-2">
                    Tambahkan elemen teks, gambar, atau link sesuai kebutuhan konten.
                  </small>

                  @include('admin._partials._elemen_builder', [
                    'existingElemen' => [],
                    'folder'         => 'uploads/safety-riding',
                  ])
                </div>

              </div>

              <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.safety-riding.index') }}" class="btn btn-secondary">
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
