/**
 * modules/guides/content-jurusan-edit.guide.js
 * Own user guide for admin/content-jurusan/edit.blade.php.
 * Self-detects via [data-guide-page="content-jurusan-edit"] on the content wrapper.
 */
import { initPageGuide } from '../user-guide.js';

export function initContentJurusanEditGuide() {
  if (!document.querySelector('[data-guide-page="content-jurusan-edit"]')) return;

  initPageGuide('content-jurusan-edit', [
    {
      target: '[data-guide="form-input"]',
      title: 'Pilih Jurusan',
      description: 'Pilih jurusan yang akan diberi content gambar.',
    },
    {
      target: '[data-guide="form-existing-images"]',
      title: 'Gambar yang Sudah Ada',
      description: 'Hapus gambar yang sudah ada di sini sebelum menyimpan perubahan, jika diperlukan.',
    },
    {
      target: '[data-guide="form-add-image"]',
      title: 'Tambah Gambar Baru',
      description: 'Tambahkan baris unggah gambar baru jika ingin melengkapi gambar yang sudah ada.',
    },
    {
      target: '[data-guide="form-back"]',
      title: 'Kembali',
      description: 'Kembali ke halaman daftar tanpa menyimpan perubahan.',
    },
    {
      target: '[data-guide="form-submit"]',
      title: 'Simpan Perubahan',
      description: 'Klik tombol ini untuk menyimpan perubahan setelah form lengkap.',
    },
  ]);
}
