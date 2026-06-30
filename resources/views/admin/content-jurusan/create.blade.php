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
                    {{-- Rows ditambahkan via JavaScript --}}
                  </div>

                  <button type="button"
                          class="btn btn-outline-primary btn-sm mt-2"
                          onclick="addImageRow()">
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

@section('scripts')
<script>
  let rowCount = 0;

  /* ============================================================
     Tambah baris upload gambar baru
  ============================================================ */
  function addImageRow() {
    rowCount++;
    const rowId = rowCount;
    const isFirst = rowId === 1;

    const row = document.createElement('div');
    row.className = 'image-upload-row card mb-2 border';
    row.dataset.rowId = rowId;

    row.innerHTML = `
      <div class="card-body py-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="small font-weight-bold text-muted">
            Gambar #<span class="row-num">${rowId}</span>
          </span>
          <button type="button"
                  class="btn btn-sm btn-outline-danger"
                  onclick="removeImageRow(this)">
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
                     class="d-none file-input"
                     ${isFirst ? 'required' : ''}>
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

    document.getElementById('imageRows').appendChild(row);
    bindDropzone(row);
  }

  /* ============================================================
     Hapus baris upload (minimal 1 baris harus tersisa)
  ============================================================ */
  function removeImageRow(btn) {
    const allRows = document.querySelectorAll('#imageRows .image-upload-row');
    if (allRows.length <= 1) {
      alert('Minimal harus ada 1 gambar!');
      return;
    }
    confirmAction('Hapus baris ini?', function() {
      btn.closest('.image-upload-row').remove();
    });
  }

  /* ============================================================
     Bind event klik & drag-drop ke dropzone sebuah baris
  ============================================================ */
  function bindDropzone(row) {
    const dropzone  = row.querySelector('.dropzone-area');
    const fileInput = row.querySelector('.file-input');
    const preview   = row.querySelector('.preview-img');
    const label     = row.querySelector('.label-filename');

    // Klik dropzone → buka file picker
    dropzone.addEventListener('click', (e) => {
      if (e.target !== fileInput) fileInput.click();
    });

    // Preview saat file dipilih
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

    // Drag & drop
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

      // Set file ke input (pakai DataTransfer API)
      try {
        const dt = new DataTransfer();
        dt.items.add(files[0]);
        fileInput.files = dt.files;
      } catch (_) { /* browser lama mungkin tidak support */ }

      label.textContent = files[0].name;
      const reader = new FileReader();
      reader.onload = (ev) => {
        preview.src = ev.target.result;
        preview.classList.remove('d-none');
      };
      reader.readAsDataURL(files[0]);
    });
  }

  // Inisialisasi: tampilkan 1 baris saat halaman dimuat
  document.addEventListener('DOMContentLoaded', () => addImageRow());
</script>
@endsection