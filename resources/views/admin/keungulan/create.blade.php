@extends('layouts.admin')

@section('title', 'Tambah Keunggulan')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Tambah Keunggulan</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.keungulan.index') }}">Keunggulan</a></li>
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
                <i class="fas fa-star mr-1"></i> Form Tambah Keunggulan
              </h3>
            </div>

            <form action="{{ route('admin.keungulan.store') }}" method="POST" enctype="multipart/form-data" id="form-keungulan-create">
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

                {{-- Nama Keunggulan diisi per baris gambar di bawah --}}

                {{-- Status Aktif --}}
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="is_active"
                           name="is_active" value="1"
                           {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="is_active">Aktif / Ditampilkan</label>
                  </div>
                </div>

                {{-- Upload Gambar (bisa banyak) --}}
                <div class="form-group">
                  <label>
                    Gambar <span class="text-danger">*</span>
                    <small class="text-muted font-weight-normal ml-1">— bisa upload 1 atau banyak sekaligus</small>
                  </label>

                  {{-- Image rows container --}}
                  <div id="keungulanImageRows"></div>

                  <button type="button" class="btn btn-sm btn-outline-primary mt-2" data-add-keungulan-row>
                    <i class="fas fa-plus"></i> Tambah Gambar
                  </button>
                </div>

              </div>

              <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.keungulan.index') }}" class="btn btn-secondary">
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

