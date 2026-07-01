@extends('layouts.admin')

@section('title', 'Edit Keunggulan')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Edit Keunggulan</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.keungulan.index') }}">Keunggulan</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card card-warning shadow-sm">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit mr-1"></i> Form Edit Keunggulan
              </h3>
            </div>

            <form action="{{ route('admin.keungulan.update', $keungulan->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">

                @if($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">
                      @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                {{-- Nama Keunggulan --}}
                <div class="form-group">
                  <label for="nama_keunggulan">Nama Keunggulan <span class="text-danger">*</span></label>
                  <input type="text" id="nama_keunggulan" name="nama_keunggulan"
                         class="form-control @error('nama_keunggulan') is-invalid @enderror"
                         value="{{ old('nama_keunggulan', $keungulan->nama_keunggulan) }}"
                         required>
                  @error('nama_keunggulan')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                {{-- Alt Text --}}
                <div class="form-group">
                  <label for="alt">Alt Text <small class="text-muted font-weight-normal">(opsional)</small></label>
                  <input type="text" id="alt" name="alt"
                         class="form-control @error('alt') is-invalid @enderror"
                         value="{{ old('alt', $keungulan->alt) }}"
                         placeholder="Deskripsi gambar untuk SEO dan aksesibilitas"
                         maxlength="255">
                  @error('alt')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                {{-- Status Aktif --}}
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="is_active"
                           name="is_active" value="1"
                           {{ old('is_active', $keungulan->is_active) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="is_active">Aktif / Ditampilkan</label>
                  </div>
                </div>

                {{-- Gambar --}}
                <div class="form-group">
                  <label>Gambar Saat Ini</label>
                  @if($keungulan->image)
                    <div class="mb-2">
                      <img src="{{ asset('storage/keungulan/' . $keungulan->image) }}"
                           alt="{{ $keungulan->alt ?? $keungulan->nama_keunggulan }}"
                           class="preview-image img-thumbnail" style="max-height:160px; border-radius:6px; cursor:pointer;">
                    </div>
                  @else
                    <p class="text-muted small">Belum ada gambar.</p>
                  @endif

                  <label>Ganti Gambar <small class="text-muted font-weight-normal">(opsional)</small></label>
                  <div id="dropzone" class="border rounded p-4 text-center"
                       style="cursor:pointer; border-style:dashed !important; transition: background .2s;">
                    <i class="fas fa-cloud-upload-alt fa-2x text-muted"></i>
                    <p class="text-muted mt-2 mb-0">Klik atau seret gambar ke sini</p>
                    <input type="file" id="fileInput" name="image" accept="image/*" class="d-none">
                  </div>
                  <img id="previewImage" class="img-fluid rounded mt-2 d-none" style="max-height:200px;" data-modal-skip="true">
                  @error('image')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>

              </div>

              <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.keungulan.index') }}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-warning">
                  <i class="fas fa-save"></i> Update
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
