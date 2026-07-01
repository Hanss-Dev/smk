@extends('layouts.admin')

@section('title', 'Edit Highlight')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Edit Highlight</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.highlight.index') }}">Highlight</a></li>
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
              <h3 class="card-title"><i class="fas fa-edit mr-1"></i> Form Edit Highlight</h3>
            </div>

            <form action="{{ route('admin.highlight.update', $highlight->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">

                @if($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                  </div>
                @endif

                <div class="form-group">
                  <label>Judul Highlight</label>
                  <input type="text" name="title" class="form-control" value="{{ old('title', $highlight->title) }}" required>
                </div>

                <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea name="description" rows="6" class="form-control" required>{{ old('description', $highlight->description) }}</textarea>
                </div>

                <div class="form-group">
                  <label>Gambar Saat Ini</label>
                  @if($highlight->image)
                    <div class="mb-2">
                      <img src="{{ asset('storage/highlight/' . $highlight->image) }}" class="preview-image img-thumbnail" style="max-height:150px; cursor:pointer;">
                    </div>
                  @endif
                  <label>Ganti Gambar (opsional)</label>
                  <div id="dropzone" class="border rounded p-4 text-center" style="cursor:pointer; border-style:dashed !important;">
                    <i class="fas fa-cloud-upload-alt fa-2x text-muted"></i>
                    <p class="text-muted mt-2">Klik atau seret gambar ke sini</p>
                    <input type="file" id="fileInput" name="image" accept="image/*" class="d-none">
                  </div>
                  <img id="previewImage" class="img-fluid rounded mt-2 d-none" style="max-height:200px;" data-modal-skip="true">
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <select name="is_active" class="form-control">
                    <option value="1" {{ old('is_active', $highlight->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active', $highlight->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>Nonaktif</option>
                  </select>
                </div>

              </div>

              <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.highlight.index') }}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-warning">
                  <i class="fas fa-save"></i> Update Highlight
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
