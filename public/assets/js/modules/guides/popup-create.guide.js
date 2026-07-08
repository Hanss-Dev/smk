/**
 * modules/guides/popup-create.guide.js
 * Own user guide for admin/popup/create.blade.php.
 * Self-detects via [data-guide-page="popup-create"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initPopupCreateGuide() {
  if (!document.querySelector('[data-guide-page="popup-create"]')) return;

  initPageGuide('popup-create', [
    {
      target: '[data-guide="form-input"]',
      title: 'Judul Popup',
      description: 'Isi judul popup yang wajib diisi.',
    },
    {
      target: '[data-guide="form-dropzone"]',
      title: 'Unggah Gambar',
      description: 'Klik atau seret gambar popup ke area ini untuk mengunggahnya.',
    },
    {
      target: '[data-guide="form-back"]',
      title: 'Kembali',
      description: 'Kembali ke halaman daftar tanpa menyimpan perubahan.',
    },
    {
      target: '[data-guide="form-submit"]',
      title: 'Simpan',
      description: 'Klik tombol ini untuk menyimpan data setelah form lengkap.',
    },
  ]);
}
