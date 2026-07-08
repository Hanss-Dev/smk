/**
 * modules/guides/dashboard.guide.js
 * Own user guide for admin/dashboard.blade.php.
 *
 * Self-detects via the page's existing `data-guide="dash-stats"` marker,
 * so no markup changes were needed on the dashboard view itself.
 *
 * NOTE: this is the fix for "user guide tidak muncul di dashboard" — the
 * old global runner put dash-stats/dash-quick-stats/dash-recent-news/
 * dash-charts in a hard-coded ignore list, so the dashboard's tour always
 * resolved to zero steps and silently never ran. Now the dashboard has its
 * own explicit step list, like every other view.
 */
import { initPageGuide } from '../user-guide.js';

export function initDashboardGuide() {
  if (!document.querySelector('[data-guide="dash-stats"]')) return;

  initPageGuide('dashboard', [
    {
      target: '[data-guide="dash-stats"]',
      title: 'Statistik Ringkas',
      description: 'Kartu-kartu ini menampilkan ringkasan jumlah data utama (berita, alumni, dan lainnya) secara sekilas.',
    },
    {
      target: '[data-guide="dash-quick-stats"]',
      title: 'Quick Statistics',
      description: 'Ringkasan cepat: persentase berita terbit, jumlah pesan yang belum dibaca, dan total pengguna terdaftar.',
    },
    {
      target: '[data-guide="dash-recent-news"]',
      title: 'Berita Terbaru',
      description: 'Daftar berita yang paling baru dipublikasikan. Klik judul berita untuk langsung membukanya di halaman edit.',
    },
    {
      target: '[data-guide="dash-charts"]',
      title: 'Grafik Statistik',
      description: 'Visualisasi data konten dalam bentuk grafik, agar tren dan perbandingan data lebih mudah dibaca.',
    },
  ]);
}
