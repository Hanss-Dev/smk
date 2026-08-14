/**
 * modules/elemen-builder.js
 * Handles: add / remove / reindex dynamic content elements (text, image, link)
 * inside the "_elemen_builder" partial.
 *
 * Required markup (see _elemen_builder.blade.php):
 *   <div id="elemen-list"> ... existing .elemen-item ... </div>
 *   <button data-add-elemen="text">+ Text</button>
 *   <button data-add-elemen="image">+ Gambar</button>
 *   <button data-add-elemen="link">+ Link</button>
 *
 * Multiple builders on one page are supported as long as each builder
 * has its own #elemen-list (only one per page in this app, but the
 * functions below are scoped to the closest container regardless).
 */

const TEMPLATES = {
  text: (i) => `
    <input type="hidden" name="elemen_type[${i}]" value="text">
    <textarea name="elemen_value[${i}]" rows="2" class="form-control form-control-sm" placeholder="Isi teks..."></textarea>`,

  image: (i) => `
    <input type="hidden" name="elemen_type[${i}]" value="image">
    <input type="hidden" name="elemen_existing[${i}]" value="">
    <div class="elemen-img-preview mb-2" style="display:none;">
      <img src="" alt="Preview" class="img-thumbnail" style="max-height:100px;" data-modal-skip="true">
      <small class="text-muted d-block">Preview gambar baru</small>
    </div>
    <div class="form-group mb-1">
      <label class="text-xs">Upload Gambar <span class="text-danger">*</span></label>
      <input type="file" name="elemen_file[${i}]" accept="image/*" class="form-control-file form-control-sm elemen-file-input">
    </div>
    <div class="form-group mb-0">
      <label class="text-xs">Alt Text</label>
      <input type="text" name="elemen_alt[${i}]" class="form-control form-control-sm" placeholder="Deskripsi gambar">
    </div>`,

  link: (i) => `
    <input type="hidden" name="elemen_type[${i}]" value="link">
    <div class="form-group mb-1">
      <label class="text-xs">URL</label>
      <input type="text" name="elemen_value[${i}]" class="form-control form-control-sm" placeholder="https://...">
    </div>
    <div class="form-group mb-0">
      <label class="text-xs">Label Link</label>
      <input type="text" name="elemen_label[${i}]" class="form-control form-control-sm" placeholder="Teks yang tampil">
    </div>`,
};

const LABELS = { text: 'TEXT', image: 'IMAGE', link: 'LINK' };

export function initElemenBuilder(root = document) {
  const list = root.querySelector('#elemen-list');
  if (!list) return;

  root.querySelectorAll('[data-add-elemen]').forEach((btn) => {
    btn.addEventListener('click', () => addElemen(list, btn.dataset.addElemen));
  });

  list.addEventListener('click', (e) => {
    const removeBtn = e.target.closest('.remove-elemen');
    if (!removeBtn) return;
    if (!confirm('Hapus elemen ini?')) return;
    removeBtn.closest('.elemen-item').remove();
    reindex(list);
  });

  // Live preview: delegasi ke #elemen-list untuk menangkap input file baru maupun yang sudah ada
  list.addEventListener('change', (e) => {
    const fileInput = e.target.closest('.elemen-file-input');
    if (!fileInput) return;
    const cardBody = fileInput.closest('.card-body');
    if (!cardBody) return;

    const previewWrapper = cardBody.querySelector('.elemen-img-preview');
    if (!previewWrapper) return;

    const file = fileInput.files && fileInput.files[0];
    if (!file) {
      previewWrapper.style.display = 'none';
      return;
    }

    const reader = new FileReader();
    reader.onload = (ev) => {
      const previewImg = previewWrapper.querySelector('img');
      if (previewImg) {
        previewImg.src = ev.target.result;
        previewImg.style.cursor = 'pointer';
        previewImg.removeAttribute('data-modal-skip');

        // Bind click buka modal (hapus listener lama dulu)
        previewImg.removeEventListener('click', previewImg._modalHandler);
        previewImg._modalHandler = () => {
          if (window.ImageModal && typeof window.ImageModal.open === 'function') {
            window.ImageModal.open(previewImg.src, previewImg.alt || 'Preview gambar');
          }
        };
        previewImg.addEventListener('click', previewImg._modalHandler);
      }
      previewWrapper.style.display = 'block';
    };
    reader.readAsDataURL(file);
  });
}

function nextIndex(list) {
  return list.querySelectorAll('.elemen-item').length;
}

function addElemen(list, type) {
  const template = TEMPLATES[type];
  if (!template) return;

  const i = nextIndex(list);
  const div = document.createElement('div');
  div.className = 'elemen-item card card-outline card-secondary mb-2';
  div.dataset.index = i;
  div.innerHTML = `
    <div class="card-header py-2 d-flex align-items-center justify-content-between">
      <span class="badge badge-secondary mr-2">${LABELS[type]}</span>
      <span class="elemen-label text-sm text-muted">Elemen baru</span>
      <button type="button" class="btn btn-danger btn-xs ml-auto remove-elemen">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="card-body py-2">${template(i)}</div>`;

  list.appendChild(div);
  reindex(list);
}

function reindex(list) {
  list.querySelectorAll('.elemen-item').forEach((item, newIdx) => {
    item.dataset.index = newIdx;
    item.querySelectorAll('[name]').forEach((el) => {
      el.name = el.name.replace(/\[\d+\]/, `[${newIdx}]`);
    });
  });
}