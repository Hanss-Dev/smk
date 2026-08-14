/**
 * modules/guides/news-create.guide.js
 * Own user guide for admin/news/create.blade.php.
 * Self-detects via [data-guide-page="news-create"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initNewsCreateGuide() {
  if (!document.querySelector('[data-guide-page="news-create"]')) return;

  initPageGuide('news-create', [
    {
      target: '[data-guide="form-input"]',
      title: 'Judul Berita',
      description: 'Isi judul berita yang wajib diisi.',
    },
    {
      target: '[data-guide="form-dropzone"]',
      title: 'Unggah Thumbnail',
      description: 'Klik atau seret gambar thumbnail ke area ini untuk mengunggahnya.',
    },
    {
      target: '[data-guide="form-back"]',
      title: 'Kembali',
      description: 'Kembali ke halaman daftar tanpa menyimpan perubahan.',
    },
    {
      target: '[data-guide="form-submit"]',
      title: 'Simpan',
      description: 'Klik tombol ini untuk menyimpan data setelah form lengkap.',
    },
  ]);
}
