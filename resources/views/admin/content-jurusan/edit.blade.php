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
                                      onclick="deleteExistingImage(this, '{{ $item['image'] }}')">
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
                    {{-- Rows ditambahkan via JavaScript --}}
                  </div>

                  <button type="button"
                          class="btn btn-outline-primary btn-sm mt-2"
                          onclick="addNewImageRow()">
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

@section('scripts')
<script>
  /* ============================================================
     Hapus Gambar yang Sudah Ada
     - Menghapus card dari DOM (hidden input ikut hilang)
     - Controller akan mendeteksi gambar yg tidak ada di form
       dan menghapusnya dari disk
  ============================================================ */
  function deleteExistingImage(btn, imageName) {
    if (!confirm('Hapus gambar ini?\nGambar akan dihapus permanen dari server setelah kamu menyimpan perubahan.')) {
      return;
    }

    btn.closest('.existing-image-card').remove();

    // Tampilkan pesan jika tidak ada gambar tersisa
    const remaining = document.querySelectorAll('#existingImagesContainer .existing-image-card');
    if (remaining.length === 0) {
      const container = document.getElementById('existingImagesContainer');
      if (container) {
        container.innerHTML = `
          <div class="col-12">
            <div class="alert alert-warning">
              <i class="fas fa-exclamation-triangle mr-1"></i>
              Semua gambar dihapus. Pastikan menambahkan setidaknya 1 gambar baru sebelum menyimpan.
            </div>
          </div>
        `;
      }
    }
  }

  /* ============================================================
     Tambah Baris Gambar Baru (untuk upload)
  ============================================================ */
  let newRowCount = 0;

  function addNewImageRow() {
    newRowCount++;
    const rowId = newRowCount;

    const row = document.createElement('div');
    row.className = 'image-upload-row card mb-2 border';
    row.dataset.rowId = rowId;

    row.innerHTML = `
      <div class="card-body py-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="small font-weight-bold text-muted">
            Gambar Baru #${rowId}
          </span>
          <button type="button"
                  class="btn btn-sm btn-outline-danger"
                  onclick="removeNewRow(this)">
            <i class="fas fa-times"></i> Hapus Baris
          </button>
        </div>

        <div class="row align-items-start">
          <div class="col-md-5 mb-2">
            <div class="dropzone-area rounded text-center p-3"
                 style="cursor:pointer;
                        border:2px dashed #ced4da;
                        background:#f8f9fa;
                        min-height:115px;
                        transition:background .2s;">
              <i class="fas fa-cloud-upload-alt fa-2x text-muted mt-1"></i>
              <p class="text-muted small mt-1 mb-0 label-filename">
                Klik atau seret gambar ke sini
              </p>
              <input type="file"
                     name="images[]"
                     accept="image/*"
                     class="d-none file-input">
            </div>
            <img class="img-fluid rounded preview-img d-none mt-2"
                 style="max-height:130px; width:100%; object-fit:cover;">
          </div>

          <div class="col-md-7">
            <label class="small font-weight-bold">
              Alt Text
              <span class="text-muted font-weight-normal">(opsional)</span>
            </label>
            <textarea name="alts[]"
                      class="form-control form-control-sm"
                      rows="4"
                      placeholder="Deskripsi gambar untuk aksesibilitas dan SEO..."
                      maxlength="255"></textarea>
            <small class="text-muted">Maks. 255 karakter</small>
          </div>
        </div>
      </div>
    `;

    document.getElementById('newImageRows').appendChild(row);
    bindDropzone(row);
  }

  function removeNewRow(btn) {
    if (confirm('Hapus baris ini?')) {
      btn.closest('.image-upload-row').remove();
    }
  }

  /* ============================================================
     Bind Dropzone Behavior ke Satu Baris
  ============================================================ */
  function bindDropzone(row) {
    const dropzone  = row.querySelector('.dropzone-area');
    const fileInput = row.querySelector('.file-input');
    const preview   = row.querySelector('.preview-img');
    const label     = row.querySelector('.label-filename');

    dropzone.addEventListener('click', (e) => {
      if (e.target !== fileInput) fileInput.click();
    });

    fileInput.addEventListener('change', () => {
      const file = fileInput.files[0];
      if (!file) return;
      label.textContent = file.name;
      const reader = new FileReader();
      reader.onload = (ev) => {
        preview.src = ev.target.result;
        preview.classList.remove('d-none');
      };
      reader.readAsDataURL(file);
    });

    dropzone.addEventListener('dragover', (e) => {
      e.preventDefault();
      dropzone.style.background = '#e9ecef';
    });
    dropzone.addEventListener('dragleave', () => {
      dropzone.style.background = '#f8f9fa';
    });
    dropzone.addEventListener('drop', (e) => {
      e.preventDefault();
      dropzone.style.background = '#f8f9fa';
      const files = e.dataTransfer.files;
      if (!files.length || !files[0].type.startsWith('image/')) return;

      try {
        const dt = new DataTransfer();
        dt.items.add(files[0]);
        fileInput.files = dt.files;
      } catch (_) { /* browser lama */ }

      label.textContent = files[0].name;
      const reader = new FileReader();
      reader.onload = (ev) => {
        preview.src = ev.target.result;
        preview.classList.remove('d-none');
      };
      reader.readAsDataURL(files[0]);
    });
  }
</script>
@endsection