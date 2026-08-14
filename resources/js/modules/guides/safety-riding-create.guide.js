/**
 * modules/guides/safety-riding-create.guide.js
 * Own user guide for admin/safety-riding/create.blade.php.
 * Self-detects via [data-guide-page="safety-riding-create"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initSafetyRidingCreateGuide() {
  if (!document.querySelector('[data-guide-page="safety-riding-create"]')) return;

  initPageGuide('safety-riding-create', [
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
      title: 'Simpan',
      description: 'Klik tombol ini untuk menyimpan data setelah form lengkap.',
    },
  ]);
}
