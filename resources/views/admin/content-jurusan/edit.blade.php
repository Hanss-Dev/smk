@extends('layouts.admin')

@section('title', 'Edit Content Jurusan')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Edit Content Jurusan</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.content-jurusan.index') }}">Content Jurusan</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-11">
          <div class="card card-warning shadow-sm">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit mr-1"></i> Form Edit Content Jurusan
              </h3>
            </div>

            <form id="editForm"
                  action="{{ route('admin.content-jurusan.update', $contentJurusan->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
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

                {{-- ========================
                     Pilih Jurusan
                ======================== --}}
                <div class="form-group">
                  <label>Jurusan <span class="text-danger">*</span></label>
                  <select name="jurusan" class="form-control" required>
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusanList as $j)
                      <option value="{{ $j }}"
                        {{ old('jurusan', $contentJurusan->jurusan) == $j ? 'selected' : '' }}>
                        {{ $j }}
                      </option>
                    @endforeach
                  </select>
                </div>

                {{-- ========================
                     Gambar Yang Sudah Ada
                ======================== --}}
                <div class="form-group">
                  <label>Gambar Saat Ini</label>
                  <small class="text-muted d-block mb-2">
                    Klik tombol <span class="text-danger font-weight-bold"><i class="fas fa-times"></i></span>
                    pada pojok gambar untuk menghapusnya. Perubahan berlaku setelah disimpan.
                    Alt text bisa diedit langsung di bawah tiap gambar.
                  </small>

                  @if(count($images) > 0)
                    <div class="row" id="existingImagesContainer">
                      @foreach($images as $key => $item)
                        <div class="col-md-4 col-lg-3 mb-3 existing-image-card" data-key="{{ $key }}">
                          <div class="card border h-100 shadow-sm">

                            {{-- Thumbnail + Tombol Hapus --}}
                            <div class="position-relative">
                              <img src="{{ asset('uploads/jurusan/' . $item['image']) }}"
                                   class="card-img-top"
                                   style="height:150px; object-fit:cover;"
                                   alt="{{ $item['alt'] ?? '' }}">

                              <button type="button"
                                      class="btn btn-danger btn-sm position-absolute"
                                      style="top:6px; right:6px; width:28px; height:28px;
                                             padding:0; line-height:1;"
                                      title="Hapus gambar ini"
                                      data-remove-existing
                                      data-image="{{ $item['image'] }}">
                                <i class="fas fa-times"></i>
                              </button>

                              {{-- Hidden: nama file (agar dikirim ke controller sebagai "masih ada") --}}
                              <input type="hidden"
                                     name="existing_images[{{ $key }}]"
                                     value="{{ $item['image'] }}">
                            </div>

                            {{-- Alt Text Input --}}
                            <div class="card-body p-2">
                              <label class="small font-weight-bold mb-1">
                                Alt Text
                                <span class="text-muted font-weight-normal">(opsional)</span>
                              </label>
                              <input type="text"
                                     name="existing_alts[{{ $key }}]"
                                     class="form-control form-control-sm"
                                     value="{{ old('existing_alts.' . $key, $item['alt'] ?? '') }}"
                                     placeholder="Deskripsi gambar..."
                                     maxlength="255">
                            </div>

                          </div>
                        </div>
                      @endforeach
                    </div>
                  @else
                    <div class="alert alert-info" id="noImagesAlert">
                      Belum ada gambar. Tambahkan gambar baru di bagian bawah.
                    </div>
                  @endif
                </div>

                <hr>

                {{-- ========================
                     Tambah Gambar Baru
                ======================== --}}
                <div class="form-group">
                  <label>Tambah Gambar Baru</label>
                  <small class="text-muted d-block mb-2">
                    Opsional – tambahkan gambar baru untuk melengkapi yang sudah ada.
                    Format: JPEG, PNG, JPG, WEBP. Maks. 2 MB per gambar.
                  </small>

                  <div id="newImageRows">
                    {{-- Rows ditambahkan via admin.js → modules/content-jurusan-edit.js --}}
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
                <button type="submit" class="btn btn-warning">
                  <i class="fas fa-save"></i> Simpan Perubahan
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