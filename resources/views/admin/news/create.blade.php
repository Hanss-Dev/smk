@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Tambah Berita</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">Berita</a></li>
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
              <h3 class="card-title"><i class="fas fa-newspaper mr-1"></i> Form Tambah Berita</h3>
            </div>

            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body">

                @if($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                  </div>
                @endif

                <div class="form-group">
                  <label>Judul Berita</label>
                  <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="form-group">
                  <label>Thumbnail</label>
                  <div id="dropzone" class="border rounded p-4 text-center" style="cursor:pointer; border-style:dashed !important;">
                    <i class="fas fa-cloud-upload-alt fa-2x text-muted"></i>
                    <p class="text-muted mt-2">Klik atau seret gambar ke sini</p>
                    <input type="file" id="fileInput" name="thumbnail" accept="image/*" class="d-none" required>
                  </div>
                  <img id="previewImage" class="img-fluid rounded mt-2 d-none" style="max-height:200px;">
                </div>

                <div class="form-group">
                  <label>Konten Berita</label>
                  <textarea name="content" rows="10" class="form-control" required>{{ old('content') }}</textarea>
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                  </select>
                </div>

              </div>

              <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save"></i> Simpan Berita
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
