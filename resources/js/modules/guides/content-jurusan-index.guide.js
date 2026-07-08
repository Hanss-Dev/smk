/**
 * modules/guides/content-jurusan-index.guide.js
 * Own user guide for admin/content-jurusan/index.blade.php.
 * Self-detects via [data-guide-page="content-jurusan-index"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initContentJurusanIndexGuide() {
  if (!document.querySelector('[data-guide-page="content-jurusan-index"]')) return;

  initPageGuide('content-jurusan-index', [
    {
      target: '[data-guide="index-search"]',
      title: 'Pencarian',
      description: 'Gunakan filter ini untuk menampilkan content berdasarkan jurusan tertentu.',
    },
    {
      target: '[data-guide="index-add-btn"]',
      title: 'Tambah Content Jurusan',
      description: 'Klik tombol ini untuk membuka halaman penambahan content jurusan baru.',
    },
    {
      target: '[data-guide="index-bulk-delete"]',
      title: 'Hapus Massal',
      description: 'Pilih beberapa data content jurusan, lalu klik tombol ini untuk menghapusnya sekaligus.',
    },
    {
      target: '[data-guide="index-table"]',
      title: 'Daftar Content Jurusan',
      description: 'Semua content jurusan yang tersimpan ditampilkan pada tabel ini.',
    },
    {
      target: '[data-guide="index-row-actions"]',
      title: 'Aksi Baris',
      description: 'Gunakan tombol aksi pada baris ini untuk mengedit atau menghapus content jurusan.',
    },
  ]);
}
