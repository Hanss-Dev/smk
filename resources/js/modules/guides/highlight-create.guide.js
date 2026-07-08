/**
 * modules/guides/highlight-create.guide.js
 * Own user guide for admin/highlight/create.blade.php.
 * Self-detects via [data-guide-page="highlight-create"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initHighlightCreateGuide() {
  if (!document.querySelector('[data-guide-page="highlight-create"]')) return;

  initPageGuide('highlight-create', [
    {
      target: '[data-guide="form-input"]',
      title: 'Judul Highlight',
      description: 'Isi judul highlight yang wajib diisi.',
    },
    {
      target: '[data-guide="form-dropzone"]',
      title: 'Unggah Gambar',
      description: 'Klik atau seret gambar ke area ini untuk mengunggah file.',
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
