/**
 * modules/guides/safety-riding-index.guide.js
 * Own user guide for admin/safety-riding/index.blade.php.
 * Self-detects via [data-guide-page="safety-riding-index"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initSafetyRidingIndexGuide() {
  if (!document.querySelector('[data-guide-page="safety-riding-index"]')) return;

  initPageGuide('safety-riding-index', [
    {
      target: '[data-guide="index-search"]',
      title: 'Pencarian',
      description: 'Gunakan kolom ini untuk mencari bagian Safety Riding berdasarkan nama atau kata kunci tertentu.',
    },
    {
      target: '[data-guide="index-add-btn"]',
      title: 'Tambah Safety Riding',
      description: 'Klik tombol ini untuk membuka halaman penambahan bagian Safety Riding baru.',
    },
    {
      target: '[data-guide="index-bulk-delete"]',
      title: 'Hapus Massal',
      description: 'Pilih beberapa bagian, lalu klik tombol ini untuk menghapusnya sekaligus.',
    },
    {
      target: '[data-guide="index-table"]',
      title: 'Daftar Safety Riding',
      description: 'Semua bagian halaman Safety Riding ditampilkan pada tabel ini.',
    },
    {
      target: '[data-guide="index-row-actions"]',
      title: 'Aksi Baris',
      description: 'Gunakan tombol aksi pada baris ini untuk mengedit atau menghapus bagian ini.',
    },
  ]);
}
