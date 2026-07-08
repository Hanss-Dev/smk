/**
 * modules/guides/content-jurusan-create.guide.js
 * Own user guide for admin/content-jurusan/create.blade.php.
 * Self-detects via [data-guide-page="content-jurusan-create"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initContentJurusanCreateGuide() {
  if (!document.querySelector('[data-guide-page="content-jurusan-create"]')) return;

  initPageGuide('content-jurusan-create', [
    {
      target: '[data-guide="form-input"]',
      title: 'Pilih Jurusan',
      description: 'Pilih jurusan yang akan diberi content gambar.',
    },
    {
      target: '[data-guide="form-add-image"]',
      title: 'Tambah Gambar',
      description: 'Tambahkan baris unggah gambar lagi jika ingin mengunggah lebih dari satu gambar.',
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
