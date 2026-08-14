/**
 * modules/guides/highlight-edit.guide.js
 * Own user guide for admin/highlight/edit.blade.php.
 * Self-detects via [data-guide-page="highlight-edit"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initHighlightEditGuide() {
  if (!document.querySelector('[data-guide-page="highlight-edit"]')) return;

  initPageGuide('highlight-edit', [
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
      title: 'Simpan Perubahan',
      description: 'Klik tombol ini untuk menyimpan perubahan setelah form lengkap.',
    },
  ]);
}
