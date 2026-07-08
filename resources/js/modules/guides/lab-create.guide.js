/**
 * modules/guides/lab-create.guide.js
 * Own user guide for admin/lab/create.blade.php.
 * Self-detects via [data-guide-page="lab-create"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initLabCreateGuide() {
  if (!document.querySelector('[data-guide-page="lab-create"]')) return;

  initPageGuide('lab-create', [
    {
      target: '[data-guide="form-input"]',
      title: 'Nama Bagian',
      description: 'Isi nama bagian, akan tampil sebagai judul di halaman Lab Komputer.',
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
