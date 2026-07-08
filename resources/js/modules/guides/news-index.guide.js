/**
 * modules/guides/news-index.guide.js
 * Own user guide for admin/news/index.blade.php.
 * Self-detects via [data-guide-page="news-index"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initNewsIndexGuide() {
  if (!document.querySelector('[data-guide-page="news-index"]')) return;

  initPageGuide('news-index', [
    {
      target: '[data-guide="index-search"]',
      title: 'Pencarian',
      description: 'Gunakan kolom ini untuk mencari berita berdasarkan judul atau kata kunci tertentu.',
    },
    {
      target: '[data-guide="index-add-btn"]',
      title: 'Tambah Berita',
      description: 'Klik tombol ini untuk membuka halaman penambahan berita baru.',
    },
    {
      target: '[data-guide="index-bulk-delete"]',
      title: 'Hapus Massal',
      description: 'Pilih beberapa berita, lalu klik tombol ini untuk menghapusnya sekaligus.',
    },
    {
      target: '[data-guide="index-table"]',
      title: 'Daftar Berita',
      description: 'Semua berita yang tersimpan ditampilkan pada tabel ini.',
    },
    {
      target: '[data-guide="index-row-actions"]',
      title: 'Aksi Baris',
      description: 'Gunakan tombol aksi pada baris ini untuk mengedit atau menghapus berita.',
    },
  ]);
}
