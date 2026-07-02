@extends('layouts.admin')

@section('title', 'Tambah Content Jurusan')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Tambah Content Jurusan</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.content-jurusan.index') }}">Content Jurusan</a></li>
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
                <i class="fas fa-images mr-1"></i> Form Tambah Content Jurusan
              </h3>
            </div>

            <form action="{{ route('admin.content-jurusan.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  id="createForm">
              @csrf
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

                {{-- Pilih Jurusan --}}
                <div class="form-group">
                  <label>
                    Jurusan <span class="text-danger">*</span>
                  </label>
                  <select name="jurusan" class="form-control" required>
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusanList as $j)
                      <option value="{{ $j }}" {{ old('jurusan') == $j ? 'selected' : '' }}>
                        {{ $j }}
                      </option>
                    @endforeach
                  </select>
                </div>

                {{-- Upload Gambar --}}
                <div class="form-group">
                  <label>
                    Gambar <span class="text-danger">*</span>
                  </label>
                  <small class="text-muted d-block mb-2">
                    Minimal 1 gambar. Format: JPEG, PNG, JPG, WEBP. Maks. 2 MB per gambar.
                    Alt text bersifat opsional.
                  </small>

                  <div id="imageRows">
                    {{-- Rows ditambahkan via admin.js → modules/content-jurusan-create.js --}}
                  </div>

                  <button type="button"
                          class="btn btn-outline-primary btn-sm mt-2"
                          data-add-image-row>
                    <i class="fas fa-plus"></i> Tambah Gambar
                  </button>
                </div>

              </div>

              <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.content-jurusan.index') }}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save"></i> Simpan
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