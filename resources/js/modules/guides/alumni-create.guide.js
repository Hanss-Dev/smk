/**
 * modules/guides/alumni-create.guide.js
 * Own user guide for admin/alumni/create.blade.php.
 * Self-detects via [data-guide-page="alumni-create"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initAlumniCreateGuide() {
  if (!document.querySelector('[data-guide-page="alumni-create"]')) return;

  initPageGuide('alumni-create', [
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
      title: 'Simpan',
      description: 'Klik tombol ini untuk menyimpan data setelah form lengkap.',
    },
  ]);
}
