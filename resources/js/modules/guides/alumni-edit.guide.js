/**
 * modules/guides/alumni-edit.guide.js
 * Own user guide for admin/alumni/edit.blade.php.
 * Self-detects via [data-guide-page="alumni-edit"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initAlumniEditGuide() {
  if (!document.querySelector('[data-guide-page="alumni-edit"]')) return;

  initPageGuide('alumni-edit', [
    {
      target: '[data-guide="form-input"]',
      title: 'Nama Siswa',
      description: 'Isi nama siswa alumni yang ingin ditambahkan/diperbarui.',
    },
    {
      target: '[data-guide="form-dropzone"]',
      title: 'Unggah Gambar',
      description: 'Klik atau seret foto alumni ke area ini untuk mengunggahnya.',
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
