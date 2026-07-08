/**
 * modules/guides/pesan-index.guide.js
 * Own user guide for admin/pesan/index.blade.php.
 * Self-detects via [data-guide-page="pesan-index"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initPesanIndexGuide() {
  if (!document.querySelector('[data-guide-page="pesan-index"]')) return;

  initPageGuide('pesan-index', [
    {
      target: '[data-guide="index-search"]',
      title: 'Pencarian',
      description: 'Gunakan kolom ini untuk mencari pesan berdasarkan nama, email, atau kata kunci tertentu.',
    },
    {
      target: '[data-guide="index-bulk-delete"]',
      title: 'Hapus Massal',
      description: 'Pilih beberapa pesan, lalu klik tombol ini untuk menghapusnya sekaligus.',
    },
    {
      target: '[data-guide="index-table"]',
      title: 'Daftar Pesan',
      description: 'Semua pesan yang masuk dari form "Hubungi Kami" ditampilkan pada tabel ini. Baris tercetak tebal berarti belum dibaca.',
    },
    {
      target: '[data-guide="index-row-actions"]',
      title: 'Aksi Pesan',
      description: 'Klik "Baca" untuk melihat detail, "Balas" untuk membalas langsung, atau hapus pesan yang sudah tidak diperlukan.',
    },
  ]);
}
