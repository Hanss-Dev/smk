/**
 * modules/guides/podcast-create.guide.js
 * Own user guide for admin/podcast/create.blade.php.
 * Self-detects via [data-guide-page="podcast-create"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initPodcastCreateGuide() {
  if (!document.querySelector('[data-guide-page="podcast-create"]')) return;

  initPageGuide('podcast-create', [
    {
      target: '[data-guide="form-input"]',
      title: 'Nama Bagian',
      description: 'Isi nama bagian, akan tampil sebagai judul di halaman Podcast.',
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
