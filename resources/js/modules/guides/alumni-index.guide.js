/**
 * modules/guides/alumni-index.guide.js
 * Own user guide for admin/alumni/index.blade.php.
 * Self-detects via [data-guide-page="alumni-index"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initAlumniIndexGuide() {
  if (!document.querySelector('[data-guide-page="alumni-index"]')) return;

  initPageGuide('alumni-index', [
    {
      target: '[data-guide="index-search"]',
      title: 'Pencarian',
      description: 'Gunakan kolom ini untuk mencari data alumni berdasarkan nama, jurusan, atau kata kunci lainnya.',
    },
    {
      target: '[data-guide="index-add-btn"]',
      title: 'Tambah Alumni',
      description: 'Klik tombol ini untuk membuka halaman penambahan data alumni baru.',
    },
    {
      target: '[data-guide="index-bulk-delete"]',
      title: 'Hapus Massal',
      description: 'Pilih beberapa data alumni, lalu klik tombol ini untuk menghapusnya sekaligus.',
    },
    {
      target: '[data-guide="index-table"]',
      title: 'Daftar Alumni',
      description: 'Semua data alumni yang tersimpan ditampilkan pada tabel ini.',
    },
    {
      target: '[data-guide="index-row-actions"]',
      title: 'Aksi Baris',
      description: 'Gunakan tombol aksi pada baris ini untuk mengedit atau menghapus data alumni.',
    },
  ]);
}
