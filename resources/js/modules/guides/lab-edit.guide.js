/**
 * modules/guides/lab-edit.guide.js
 * Own user guide for admin/lab/edit.blade.php.
 * Self-detects via [data-guide-page="lab-edit"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initLabEditGuide() {
  if (!document.querySelector('[data-guide-page="lab-edit"]')) return;

  initPageGuide('lab-edit', [
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
      title: 'Simpan Perubahan',
      description: 'Klik tombol ini untuk menyimpan perubahan setelah form lengkap.',
    },
  ]);
}
