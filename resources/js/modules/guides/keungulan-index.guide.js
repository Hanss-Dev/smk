/**
 * modules/guides/keungulan-index.guide.js
 * Own user guide for admin/keungulan/index.blade.php.
 * Self-detects via [data-guide-page="keungulan-index"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initKeungulanIndexGuide() {
  if (!document.querySelector('[data-guide-page="keungulan-index"]')) return;

  initPageGuide('keungulan-index', [
    {
      target: '[data-guide="index-search"]',
      title: 'Pencarian',
      description: 'Gunakan kolom ini untuk mencari keunggulan berdasarkan nama atau kata kunci tertentu.',
    },
    {
      target: '[data-guide="index-add-btn"]',
      title: 'Tambah Keunggulan',
      description: 'Klik tombol ini untuk membuka halaman penambahan keunggulan baru.',
    },
    {
      target: '[data-guide="index-bulk-delete"]',
      title: 'Hapus Massal',
      description: 'Pilih beberapa data keunggulan, lalu klik tombol ini untuk menghapusnya sekaligus.',
    },
    {
      target: '[data-guide="index-table"]',
      title: 'Daftar Keunggulan',
      description: 'Semua data keunggulan yang tersimpan ditampilkan pada tabel ini.',
    },
    {
      target: '[data-guide="index-row-actions"]',
      title: 'Aksi Baris',
      description: 'Gunakan tombol aksi pada baris ini untuk mengedit atau menghapus data keunggulan.',
    },
  ]);
}
