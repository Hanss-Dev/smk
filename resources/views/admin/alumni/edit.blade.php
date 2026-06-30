@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Edit Data Alumni</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.alumni.index') }}">Data Alumni</a></li>
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
              <h3 class="card-title"><i class="fas fa-newspaper mr-1"></i> Form Edit Data Alumni</h3>
            </div>

            <form action="{{ route('admin.alumni.update', $alumni->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">

                @if($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                  </div>
                @endif

                <div class="form-group">
                  <label>Nama Siswa</label>
                  <input type="text" name="NamaSiswa" class="form-control" value="{{ old('title', $alumni->nama_alumni) }}" required>
                </div>

                <div class="form-group">
                  <label>Gambar Saat Ini</label>
                  @if($alumni->image)
                    <div class="mb-2">
                      <img src="{{ asset('storage/alumni/' . $alumni->image) }}" class="img-thumbnail" style="max-height:150px;">
                    </div>
                  @endif
                  <label>Ganti Gambar (opsional)</label>
                  <div id="dropzone" class="border rounded p-4 text-center" style="cursor:pointer; border-style:dashed !important;">
                    <i class="fas fa-cloud-upload-alt fa-2x text-muted"></i>
                    <p class="text-muted mt-2">Klik atau seret gambar ke sini</p>
                    <input type="file" id="fileInput" name="GambarAlumni" accept="image/*" class="d-none">
                  </div>
                  <img id="previewImage" class="img-fluid rounded mt-2 d-none" style="max-height:200px;">
                </div>

                <div class="form-group">
                  <label>Alumni Jurusan</label>
                  <input type="text" name="AlumniJurusan" class="form-control" value="{{ old('AlumniJurusan', $alumni->jurusan_alumni) }}" required>
                </div>

                <div class="form-group">
                  <label>Nama Pekerjaan</label>
                  <input type="text" name="NamaPekerjaan" class="form-control" value="{{ old('NamaPekerjaan', $alumni->nama_pekerjaan) }}" required>
                </div>

                <div class="form-group">
                  <label>Nama Perusahann</label>
                  <input type="text" name="NamaPerusahaan" class="form-control" value="{{ old('NamaPerusahaan', $alumni->nama_perusahaan) }}" required>
                </div>

              </div>

              <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-warning">
                  <i class="fas fa-save"></i> Update Berita
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
