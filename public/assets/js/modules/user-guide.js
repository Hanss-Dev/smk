import { driver } from '../vendor/driver.js.mjs';

const STORAGE_KEY = 'admin_guide_seen_v1';

function addStep(steps, target, popover, condition = true) {
  const el = typeof target === 'string' ? document.querySelector(target) : target;
  if (!el) {
    return;
  }

  if (typeof condition === 'function' ? !condition() : !condition) {
    return;
  }

  const style = window.getComputedStyle(el);
  const isVisible = style.display !== 'none' && style.visibility !== 'hidden' && el.offsetParent !== null;
  if (!isVisible) {
    return;
  }

  steps.push({ element: el, popover });
}

function getGuideMeta(key) {
  const metaMap = {
    'index-search': {
      title: 'Pencarian',
      description: 'Gunakan kolom ini untuk mencari data berdasarkan kata kunci tertentu.',
    },
    'index-add-btn': {
      title: 'Tambah Data',
      description: 'Klik tombol ini untuk membuka halaman penambahan data baru.',
    },
    'pagination-controls': {
      title: 'Navigasi Halaman',
      description: 'Atur jumlah data yang ditampilkan per halaman atau tampilkan semua data.',
    },
    'index-bulk-delete': {
      title: 'Hapus Massal',
      description: 'Pilih beberapa data, lalu klik tombol ini untuk menghapus sekaligus.',
    },
    'index-table': {
      title: 'Daftar Data',
      description: 'Semua data yang tersimpan ditampilkan pada tabel ini.',
    },
    'index-row-actions': {
      title: 'Aksi Baris',
      description: 'Gunakan tombol aksi pada baris ini untuk mengedit atau menghapus data.',
    },
    'form-input': {
      title: 'Form Input',
      description: 'Lengkapi seluruh field yang wajib diisi sebelum menyimpan.',
    },
    'form-dropzone': {
      title: 'Unggah Gambar',
      description: 'Klik atau seret gambar ke area ini untuk mengunggah file.',
    },
    'form-add-image': {
      title: 'Tambah Gambar',
      description: 'Tambahkan baris unggah gambar lagi jika dibutuhkan.',
    },
    'form-existing-images': {
      title: 'Gambar yang Sudah Ada',
      description: 'Hapus gambar yang sudah ada sebelum menyimpan perubahan.',
    },
    'form-submit': {
      title: 'Simpan',
      description: 'Klik tombol ini untuk menyimpan data setelah form lengkap.',
    },
    'form-back': {
      title: 'Kembali',
      description: 'Kembali ke halaman daftar tanpa menyimpan perubahan.',
    },
    'detail-table': {
      title: 'Detail Pesan',
      description: 'Lihat informasi lengkap pengirim dan isi pesan di bagian ini.',
    },
    'detail-actions': {
      title: 'Aksi Pesan',
      description: 'Balas atau hapus pesan ini sesuai kebutuhan.',
    },
  };

  return metaMap[key] || {
    title: 'Bagian ini',
    description: 'Bagian ini dipandu agar Anda lebih mudah memahami halaman ini.',
  };
}

function buildStepsForCurrentPage() {
  const steps = [];
  const seenGuideKeys = new Set();
  const ignoredGuideKeys = new Set([
    'menu-toggle',
    'sidebar-toggle',
    'menu-dashboard',
    'menu-konten',
    'menu-halaman',
    'menu-pesan',
    'sidebar-logout',
    'dash-stats',
    'dash-quick-stats',
    'dash-recent-news',
    'dash-charts',
    'pagination-controls',
  ]);

  document.querySelectorAll('[data-guide]').forEach((el) => {
    const key = el.getAttribute('data-guide');
    if (!key || ignoredGuideKeys.has(key) || seenGuideKeys.has(key)) {
      return;
    }

    seenGuideKeys.add(key);
    const meta = getGuideMeta(key);
    const title = el.getAttribute('data-guide-title') || meta.title;
    const description = el.getAttribute('data-guide-description') || meta.description;

    addStep(steps, el, { title, description });
  });

  return steps;
}

function startTour() {
  const steps = buildStepsForCurrentPage();
  if (steps.length === 0) return;

  const driverObj = driver({
    showProgress: true,
    allowClose: true,
    overlayOpacity: 0.6,
    stagePadding: 6,
    nextBtnText: 'Lanjut',
    prevBtnText: 'Kembali',
    doneBtnText: 'Selesai',
    progressText: '{{current}} dari {{total}}',
    steps,
  });

  driverObj.drive();
}

export function initUserGuide() {
  const triggerBtn = document.getElementById('guide-trigger-btn');
  if (!triggerBtn) return;

  triggerBtn.addEventListener('click', startTour);

  if (!localStorage.getItem(STORAGE_KEY)) {
    setTimeout(startTour, 600);
    localStorage.setItem(STORAGE_KEY, 'true');
  }
}
