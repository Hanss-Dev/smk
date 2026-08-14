/**
 * modules/guides/popup-edit.guide.js
 * Own user guide for admin/popup/edit.blade.php.
 * Self-detects via [data-guide-page="popup-edit"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initPopupEditGuide() {
  if (!document.querySelector('[data-guide-page="popup-edit"]')) return;

  initPageGuide('popup-edit', [
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
      title: 'Simpan Perubahan',
      description: 'Klik tombol ini untuk menyimpan perubahan setelah form lengkap.',
    },
  ]);
}
