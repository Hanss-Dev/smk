/**
 * modules/keungulan-create.js
 * Handles: dynamic multi-image upload rows with drag & drop + preview
 * for the "Tambah Keunggulan" form.
 *
 * Required markup: <div id="keungulanImageRows"></div>
 *                  button[data-add-keungulan-row]
 */

let rowCount = 0;

export function initKeungulanCreate() {
  const container = document.getElementById('keungulanImageRows');
  if (!container) return;

  // Bind "Tambah Gambar" buttons
  document.querySelectorAll('[data-add-keungulan-row]').forEach((btn) => {
    btn.addEventListener('click', () => addImageRow(container));
  });

  // Start with one empty row
  addImageRow(container);
}

function addImageRow(container) {
  rowCount++;
  const rowId  = rowCount;
  const isFirst = container.querySelectorAll('.keungulan-upload-row').length === 0;

  const row = document.createElement('div');
  row.className = 'keungulan-upload-row card mb-2 border';
  row.dataset.rowId = rowId;

  row.innerHTML = `
    <div class="card-body py-3">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="small font-weight-bold text-muted">
          Keunggulan #<span class="row-num">${rowId}</span>
        </span>
        <button type="button" class="btn btn-sm btn-outline-danger" data-remove-row>
          <i class="fas fa-times"></i> Hapus Baris
        </button>
      </div>

      <div class="form-group mb-3">
        <label class="small font-weight-bold">
          Nama Keunggulan <span class="text-danger">*</span>
        </label>
        <input type="text" name="nama_keunggulan[]" class="form-control form-control-sm"
               placeholder="Contoh: Juara Lomba Nasional" required maxlength="255">
      </div>

      <div class="row align-items-start">
        <div class="col-md-5 mb-2">
          <div class="keungulan-dropzone rounded text-center p-3"
               style="cursor:pointer; border:2px dashed #ced4da; background:#f8f9fa; min-height:115px; transition:background .2s;">
            <i class="fas fa-cloud-upload-alt fa-2x text-muted mt-1"></i>
            <p class="text-muted small mt-1 mb-0 label-filename">Klik atau seret gambar ke sini</p>
            <input type="file" name="images[]" accept="image/*" class="d-none keungulan-file-input"
                   ${isFirst ? 'required' : ''}>
          </div>
          <img class="img-fluid rounded keungulan-preview d-none mt-2"
               style="max-height:130px; width:100%; object-fit:cover;">
        </div>

        <div class="col-md-7">
          <label class="small font-weight-bold">
            Alt Text <span class="text-muted font-weight-normal">(opsional)</span>
          </label>
          <textarea name="alts[]" class="form-control form-control-sm" rows="4"
                    placeholder="Deskripsi gambar untuk aksesibilitas dan SEO..."
                    maxlength="255"></textarea>
          <small class="text-muted">Maks. 255 karakter</small>
        </div>
      </div>
    </div>`;

  container.appendChild(row);
  bindRemove(row, container);
  bindDropzone(row);
  renumberRows(container);
}

function bindRemove(row, container) {
  row.querySelector('[data-remove-row]').addEventListener('click', () => {
    const allRows = container.querySelectorAll('.keungulan-upload-row');
    if (allRows.length <= 1) {
      alert('Minimal harus ada 1 gambar!');
      return;
    }
    if (confirm('Hapus baris ini?')) {
      row.remove();
      renumberRows(container);
    }
  });
}

function renumberRows(container) {
  container.querySelectorAll('.keungulan-upload-row').forEach((r, i) => {
    const numEl = r.querySelector('.row-num');
    if (numEl) numEl.textContent = i + 1;
  });
}

function bindDropzone(row) {
  const dropzone  = row.querySelector('.keungulan-dropzone');
  const fileInput = row.querySelector('.keungulan-file-input');
  const preview   = row.querySelector('.keungulan-preview');
  const label     = row.querySelector('.label-filename');

  // Click to open file picker
  dropzone.addEventListener('click', (e) => {
    if (e.target !== fileInput) fileInput.click();
  });

  fileInput.addEventListener('change', () => {
    const file = fileInput.files[0];
    if (file) showPreview(file, label, preview);
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

    try {
      const dt = new DataTransfer();
      dt.items.add(files[0]);
      fileInput.files = dt.files;
    } catch (_) {
      /* older browsers */
    }

    showPreview(files[0], label, preview);
  });
}

function showPreview(file, label, preview) {
  label.textContent = file.name;
  const reader = new FileReader();
  reader.onload = (ev) => {
    preview.src = ev.target.result;
    preview.classList.remove('d-none');
    preview.style.cursor = 'pointer';

    // Bind click buka modal (hapus listener lama)
    preview.removeEventListener('click', preview._modalHandler);
    preview._modalHandler = () => {
      if (window.ImageModal && typeof window.ImageModal.open === 'function') {
        window.ImageModal.open(preview.src, preview.alt || label.textContent || 'Preview gambar');
      }
    };
    preview.addEventListener('click', preview._modalHandler);
  };
  reader.readAsDataURL(file);
}


