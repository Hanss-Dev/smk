/**
 * modules/guides/pesan-read.guide.js
 * Own user guide for admin/pesan/read.blade.php.
 * Self-detects via [data-guide-page="pesan-read"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initPesanReadGuide() {
  if (!document.querySelector('[data-guide-page="pesan-read"]')) return;

  initPageGuide('pesan-read', [
    {
      target: '[data-guide="detail-table"]',
      title: 'Detail Pesan',
      description: 'Lihat informasi lengkap pengirim (nama, email, telepon) dan isi pesan di bagian ini.',
    },
    {
      target: '[data-guide="detail-actions"]',
      title: 'Aksi Pesan',
      description: 'Balas pesan ini langsung dari sini, atau hapus jika sudah tidak diperlukan.',
    },
  ]);
}
