/**
 * modules/guides/safety-riding-edit.guide.js
 * Own user guide for admin/safety-riding/edit.blade.php.
 * Self-detects via [data-guide-page="safety-riding-edit"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initSafetyRidingEditGuide() {
  if (!document.querySelector('[data-guide-page="safety-riding-edit"]')) return;

  initPageGuide('safety-riding-edit', [
    {
      target: '[data-guide="form-input"]',
      title: 'Nama Bagian',
      description: 'Isi nama bagian, akan tampil sebagai judul di halaman Safety Riding.',
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
