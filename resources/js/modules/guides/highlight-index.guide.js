/**
 * modules/guides/highlight-index.guide.js
 * Own user guide for admin/highlight/index.blade.php.
 * Self-detects via [data-guide-page="highlight-index"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initHighlightIndexGuide() {
  if (!document.querySelector('[data-guide-page="highlight-index"]')) return;

  initPageGuide('highlight-index', [
    {
      target: '[data-guide="index-search"]',
      title: 'Pencarian',
      description: 'Gunakan kolom ini untuk mencari highlight berdasarkan judul atau kata kunci tertentu.',
    },
    {
      target: '[data-guide="index-add-btn"]',
      title: 'Tambah Highlight',
      description: 'Klik tombol ini untuk membuka halaman penambahan highlight baru.',
    },
    {
      target: '[data-guide="index-bulk-delete"]',
      title: 'Hapus Massal',
      description: 'Pilih beberapa highlight, lalu klik tombol ini untuk menghapusnya sekaligus.',
    },
    {
      target: '[data-guide="index-table"]',
      title: 'Daftar Highlight',
      description: 'Semua highlight yang tersimpan ditampilkan pada tabel ini.',
    },
    {
      target: '[data-guide="index-row-actions"]',
      title: 'Aksi Baris',
      description: 'Gunakan tombol aksi pada baris ini untuk mengedit atau menghapus highlight.',
    },
  ]);
}
