/**
 * modules/content-jurusan-create.js
 * Handles: dynamic image upload rows with drag & drop + preview
 * for the "Tambah Content Jurusan" form.
 *
 * Required markup: <div id="imageRows"></div>, button[data-add-image-row]
 */

let rowCount = 0;

export function initContentJurusanCreate() {
  const container = document.getElementById('imageRows');
  if (!container) return;

  document.querySelectorAll('[data-add-image-row]').forEach((btn) => {
    btn.addEventListener('click', () => addImageRow(container));
  });

  // Start with one row, matching original behaviour
  addImageRow(container);
}

function addImageRow(container) {
  rowCount++;
  const rowId = rowCount;
  const isFirst = container.querySelectorAll('.image-upload-row').length === 0;

  const row = document.createElement('div');
  row.className = 'image-upload-row card mb-2 border';
  row.dataset.rowId = rowId;

  row.innerHTML = `
    <div class="card-body py-3">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="small font-weight-bold text-muted">
          Gambar #<span class="row-num">${rowId}</span>
        </span>
        <button type="button" class="btn btn-sm btn-outline-danger" data-remove-row>
          <i class="fas fa-times"></i> Hapus Baris
        </button>
      </div>

      <div class="row align-items-start">
        <div class="col-md-5 mb-2">
          <div class="dropzone-area rounded text-center p-3"
               style="cursor:pointer; border:2px dashed #ced4da; background:#f8f9fa; min-height:115px; transition:background .2s;">
            <i class="fas fa-cloud-upload-alt fa-2x text-muted mt-1"></i>
            <p class="text-muted small mt-1 mb-0 label-filename">Klik atau seret gambar ke sini</p>
            <input type="file" name="images[]" accept="image/*" class="d-none file-input" ${isFirst ? 'required' : ''}>
          </div>
          <img class="img-fluid rounded preview-img d-none mt-2" style="max-height:130px; width:100%; object-fit:cover;">
        </div>

        <div class="col-md-7">
          <label class="small font-weight-bold">
            Alt Text <span class="text-muted font-weight-normal">(opsional)</span>
          </label>
          <textarea name="alts[]" class="form-control form-control-sm" rows="4"
                    placeholder="Deskripsi gambar untuk aksesibilitas dan SEO..." maxlength="255"></textarea>
          <small class="text-muted">Maks. 255 karakter</small>
        </div>
      </div>
    </div>`;

  container.appendChild(row);
  bindRemove(row, container);
  bindDropzone(row);
}

function bindRemove(row, container) {
  row.querySelector('[data-remove-row]').addEventListener('click', () => {
    const allRows = container.querySelectorAll('.image-upload-row');
    if (allRows.length <= 1) {
      alert('Minimal harus ada 1 gambar!');
      return;
    }
    if (confirm('Hapus baris ini?')) {
      row.remove();
    }
  });
}

function bindDropzone(row) {
  const dropzone = row.querySelector('.dropzone-area');
  const fileInput = row.querySelector('.file-input');
  const preview = row.querySelector('.preview-img');
  const label = row.querySelector('.label-filename');

  dropzone.addEventListener('click', (e) => {
    if (e.target !== fileInput) fileInput.click();
  });

  fileInput.addEventListener('change', () => {
    const file = fileInput.files[0];
    if (!file) return;
    showPreview(file, label, preview);
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
    } catch (_) {
      /* older browsers without DataTransfer support */
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
  };
  reader.readAsDataURL(file);
}