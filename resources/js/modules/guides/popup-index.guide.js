/**
 * modules/guides/popup-index.guide.js
 * Own user guide for admin/popup/index.blade.php.
 * Self-detects via [data-guide-page="popup-index"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initPopupIndexGuide() {
  if (!document.querySelector('[data-guide-page="popup-index"]')) return;

  initPageGuide('popup-index', [
    {
      target: '[data-guide="index-search"]',
      title: 'Pencarian',
      description: 'Gunakan kolom ini untuk mencari popup berdasarkan judul atau kata kunci tertentu.',
    },
    {
      target: '[data-guide="index-add-btn"]',
      title: 'Tambah Popup',
      description: 'Klik tombol ini untuk membuka halaman penambahan popup baru.',
    },
    {
      target: '[data-guide="index-bulk-delete"]',
      title: 'Hapus Massal',
      description: 'Pilih beberapa popup, lalu klik tombol ini untuk menghapusnya sekaligus.',
    },
    {
      target: '[data-guide="index-table"]',
      title: 'Daftar Popup',
      description: 'Semua popup yang tersimpan ditampilkan pada tabel ini.',
    },
    {
      target: '[data-guide="index-row-actions"]',
      title: 'Aksi Baris',
      description: 'Gunakan tombol aksi pada baris ini untuk mengedit atau menghapus popup.',
    },
  ]);
}
