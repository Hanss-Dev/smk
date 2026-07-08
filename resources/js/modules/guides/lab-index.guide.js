/**
 * modules/guides/lab-index.guide.js
 * Own user guide for admin/lab/index.blade.php.
 * Self-detects via [data-guide-page="lab-index"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initLabIndexGuide() {
  if (!document.querySelector('[data-guide-page="lab-index"]')) return;

  initPageGuide('lab-index', [
    {
      target: '[data-guide="index-search"]',
      title: 'Pencarian',
      description: 'Gunakan kolom ini untuk mencari bagian Lab Komputer berdasarkan nama atau kata kunci tertentu.',
    },
    {
      target: '[data-guide="index-add-btn"]',
      title: 'Tambah Lab Komputer',
      description: 'Klik tombol ini untuk membuka halaman penambahan bagian Lab Komputer baru.',
    },
    {
      target: '[data-guide="index-bulk-delete"]',
      title: 'Hapus Massal',
      description: 'Pilih beberapa bagian, lalu klik tombol ini untuk menghapusnya sekaligus.',
    },
    {
      target: '[data-guide="index-table"]',
      title: 'Daftar Lab Komputer',
      description: 'Semua bagian halaman Lab Komputer ditampilkan pada tabel ini.',
    },
    {
      target: '[data-guide="index-row-actions"]',
      title: 'Aksi Baris',
      description: 'Gunakan tombol aksi pada baris ini untuk mengedit atau menghapus bagian ini.',
    },
  ]);
}
