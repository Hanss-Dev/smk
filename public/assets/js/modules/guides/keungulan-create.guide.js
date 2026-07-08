/**
 * modules/guides/keungulan-create.guide.js
 * Own user guide for admin/keungulan/create.blade.php.
 * Self-detects via [data-guide-page="keungulan-create"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initKeungulanCreateGuide() {
  if (!document.querySelector('[data-guide-page="keungulan-create"]')) return;

  initPageGuide('keungulan-create', [
    {
      target: '[data-guide="form-input"]',
      title: 'Status Aktif',
      description: 'Atur apakah keunggulan ini langsung ditampilkan di halaman publik atau tidak.',
    },
    {
      target: '[data-guide="form-add-image"]',
      title: 'Tambah Gambar',
      description: 'Tambahkan baris unggah gambar lagi jika ingin mengunggah lebih dari satu keunggulan sekaligus.',
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
