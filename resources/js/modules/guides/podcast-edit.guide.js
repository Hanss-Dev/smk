/**
 * modules/guides/podcast-edit.guide.js
 * Own user guide for admin/podcast/edit.blade.php.
 * Self-detects via [data-guide-page="podcast-edit"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initPodcastEditGuide() {
  if (!document.querySelector('[data-guide-page="podcast-edit"]')) return;

  initPageGuide('podcast-edit', [
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
      title: 'Simpan Perubahan',
      description: 'Klik tombol ini untuk menyimpan perubahan setelah form lengkap.',
    },
  ]);
}
