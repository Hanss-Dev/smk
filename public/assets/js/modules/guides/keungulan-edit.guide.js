/**
 * modules/guides/keungulan-edit.guide.js
 * Own user guide for admin/keungulan/edit.blade.php.
 * Self-detects via [data-guide-page="keungulan-edit"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initKeungulanEditGuide() {
  if (!document.querySelector('[data-guide-page="keungulan-edit"]')) return;

  initPageGuide('keungulan-edit', [
    {
      target: '[data-guide="form-input"]',
      title: 'Nama Keunggulan',
      description: 'Isi nama keunggulan yang wajib diisi.',
    },
    {
      target: '[data-guide="form-dropzone"]',
      title: 'Ganti Gambar',
      description: 'Klik atau seret gambar baru ke area ini jika ingin mengganti gambar yang sudah ada.',
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
