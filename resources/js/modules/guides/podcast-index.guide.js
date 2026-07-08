/**
 * modules/guides/podcast-index.guide.js
 * Own user guide for admin/podcast/index.blade.php.
 * Self-detects via [data-guide-page="podcast-index"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initPodcastIndexGuide() {
  if (!document.querySelector('[data-guide-page="podcast-index"]')) return;

  initPageGuide('podcast-index', [
    {
      target: '[data-guide="index-search"]',
      title: 'Pencarian',
      description: 'Gunakan kolom ini untuk mencari bagian Podcast berdasarkan nama atau kata kunci tertentu.',
    },
    {
      target: '[data-guide="index-add-btn"]',
      title: 'Tambah Podcast',
      description: 'Klik tombol ini untuk membuka halaman penambahan bagian Podcast baru.',
    },
    {
      target: '[data-guide="index-bulk-delete"]',
      title: 'Hapus Massal',
      description: 'Pilih beberapa bagian, lalu klik tombol ini untuk menghapusnya sekaligus.',
    },
    {
      target: '[data-guide="index-table"]',
      title: 'Daftar Podcast',
      description: 'Semua bagian halaman Podcast ditampilkan pada tabel ini.',
    },
    {
      target: '[data-guide="index-row-actions"]',
      title: 'Aksi Baris',
      description: 'Gunakan tombol aksi pada baris ini untuk mengedit atau menghapus bagian ini.',
    },
  ]);
}
