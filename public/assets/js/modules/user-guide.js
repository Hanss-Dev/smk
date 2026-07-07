import { driver } from '../vendor/driver.js.mjs';

const STORAGE_KEY = 'admin_guide_seen_v1';

function addStep(steps, selector, popover, condition = true) {
  const el = document.querySelector(selector);
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

  steps.push({ element: selector, popover });
}

const GUIDE_STYLE_ID = 'admin-guide-sidebar-style';

function injectGuideSidebarStyle() {
  if (document.getElementById(GUIDE_STYLE_ID)) {
    return;
  }

  const style = document.createElement('style');
  style.id = GUIDE_STYLE_ID;
  style.textContent = `
    body.guide-sidebar-expanded .main-sidebar {
      width: 250px !important;
    }
    body.guide-sidebar-expanded .main-sidebar:hover {
      width: 250px !important;
    }
    body.guide-sidebar-expanded.sidebar-mini.sidebar-collapse .main-sidebar .nav-sidebar .nav-link > p,
    body.guide-sidebar-expanded.sidebar-mini.sidebar-collapse .ega-logo-text,
    body.guide-sidebar-expanded.sidebar-mini.sidebar-collapse .ega-sidebar-logout .logout-text {
      display: block !important;
      opacity: 1 !important;
      height: auto !important;
    }
    body.guide-sidebar-expanded.sidebar-mini.sidebar-collapse .main-sidebar .nav-sidebar > .nav-item > .nav-link,
    body.guide-sidebar-expanded.sidebar-mini.sidebar-collapse .main-sidebar .nav-sidebar .nav-treeview > .nav-item > .nav-link {
      justify-content: flex-start !important;
      padding: .65rem 1rem !important;
      width: auto !important;
    }
  `;
  document.head.appendChild(style);
}

function ensureGuideSidebarOpen() {
  const body = document.body;
  body.classList.remove('sidebar-collapse', 'sidebar-closed');
  localStorage.setItem('sidebar_collapsed', 'false');

  if (window.innerWidth < 992 && !body.classList.contains('sidebar-open')) {
    body.classList.add('sidebar-open');
  }
}

const guideSidebarState = {
  width: '',
  minWidth: '',
  overflow: '',
  hasSidebarCollapse: false,
  hasSidebarOpen: false,
  hasSidebarClosed: false,
};

function applyGuideSidebarInlineStyles() {
  const sidebar = document.querySelector('.main-sidebar');
  if (!sidebar) return;

  guideSidebarState.width = sidebar.style.width || '';
  guideSidebarState.minWidth = sidebar.style.minWidth || '';
  guideSidebarState.overflow = sidebar.style.overflow || '';

  sidebar.style.width = '250px';
  sidebar.style.minWidth = '250px';
  sidebar.style.overflow = 'visible';
}

function resetGuideSidebarInlineStyles() {
  const sidebar = document.querySelector('.main-sidebar');
  if (!sidebar) return;

  sidebar.style.width = guideSidebarState.width;
  sidebar.style.minWidth = guideSidebarState.minWidth;
  sidebar.style.overflow = guideSidebarState.overflow;
}

function activateGuideSidebarExpanded() {
  const body = document.body;
  guideSidebarState.hasSidebarCollapse = body.classList.contains('sidebar-collapse');
  guideSidebarState.hasSidebarOpen = body.classList.contains('sidebar-open');
  guideSidebarState.hasSidebarClosed = body.classList.contains('sidebar-closed');

  injectGuideSidebarStyle();
  ensureGuideSidebarOpen();

  body.classList.add('guide-sidebar-expanded');
  applyGuideSidebarInlineStyles();

  if (window.jQuery && window.jQuery.fn && typeof window.jQuery.fn.PushMenu === 'function') {
    window.jQuery('[data-widget="pushmenu"]').PushMenu('expand');
  }
}

function deactivateGuideSidebarExpanded() {
  const body = document.body;
  body.classList.remove('guide-sidebar-expanded');

  if (guideSidebarState.hasSidebarCollapse) {
    body.classList.add('sidebar-collapse');
  }
  if (guideSidebarState.hasSidebarClosed) {
    body.classList.add('sidebar-closed');
  }
  if (!guideSidebarState.hasSidebarOpen) {
    body.classList.remove('sidebar-open');
  }

  resetGuideSidebarInlineStyles();
}

function openGuideTreeMenu(selector) {
  const el = document.querySelector(selector);
  if (!el) {
    return;
  }

  const treeItem = el.closest('.has-treeview');
  if (treeItem && !treeItem.classList.contains('menu-open')) {
    treeItem.classList.add('menu-open');
    const link = treeItem.querySelector('> .nav-link');
    if (link) {
      link.setAttribute('aria-expanded', 'true');
    }
  }
}

// Langkah umum: header + sidebar, tampil di semua halaman admin.
function getLayoutSteps() {
  const steps = [];

  addStep(steps, '[data-guide="menu-toggle"]', {
    title: 'Menu Utama',
    description: 'Klik ikon ini untuk membuka/menutup sidebar di layar kecil (HP/tablet).',
  }, () => window.innerWidth < 992);

  addStep(steps, '[data-guide="sidebar-toggle"]', {
    title: 'Perkecil Sidebar',
    description: 'Klik untuk mempersempit sidebar agar area kerja lebih luas.',
  }, () => window.innerWidth >= 992);

  // ⬅️ step ini yang jadi "pintu masuk" ke section sidebar,
  // di sinilah sidebar baru dipaksa expand
  addStep(steps, '[data-guide="menu-dashboard"]', {
    title: 'Dashboard',
    description: 'Ringkasan statistik seluruh konten website.',
    onHighlightStarted: () => {
      activateGuideSidebarExpanded();
    },
  });

  addStep(steps, '[data-guide="menu-konten"]', {
    title: 'Kelola Konten',
    description: 'Kelola Berita, Highlight, Popup, Alumni, Keunggulan, dan Content Jurusan.',
    onHighlightStarted: () => {
      ensureGuideSidebarOpen();
      openGuideTreeMenu('[data-guide="menu-konten"]');
    },
  });

  addStep(steps, '[data-guide="menu-halaman"]', {
    title: 'Kelola Halaman',
    description: 'Kelola konten Podcast, Lab Komputer, dan Safety Riding.',
    onHighlightStarted: () => {
      ensureGuideSidebarOpen();
      openGuideTreeMenu('[data-guide="menu-halaman"]');
    },
  });

  addStep(steps, '[data-guide="menu-pesan"]', {
    title: 'Pesan Masuk',
    description: 'Lihat dan balas pesan yang dikirim melalui form kontak website.',
  });

  addStep(steps, '[data-guide="sidebar-logout"]', {
    title: 'Logout',
    description: 'Klik di sini untuk keluar dari panel admin.',
  });

  return steps;
}

// Langkah khusus halaman Dashboard.
function getDashboardSteps() {
  const steps = [];

  addStep(steps, '[data-guide="dash-stats"]', {
    title: 'Statistik Konten',
    description: 'Ringkasan jumlah data pada tiap menu. Klik "Lihat" untuk membuka menu terkait.',
  });
  addStep(steps, '[data-guide="dash-quick-stats"]', {
    title: 'Quick Statistics',
    description: 'Persentase berita terbit, jumlah pesan belum dibaca, dan total pengguna terdaftar.',
  });
  addStep(steps, '[data-guide="dash-recent-news"]', {
    title: 'Berita Terbaru',
    description: 'Daftar berita yang baru saja ditambahkan atau diubah.',
  });
  addStep(steps, '[data-guide="dash-charts"]', {
    title: 'Grafik',
    description: 'Visualisasi jumlah konten dan status berita (terbit/draft).',
  });

  return steps;
}

// Langkah khusus halaman daftar/index (berlaku untuk semua resource: alumni,
// berita, highlight, dll — selama memakai pola blade yang sama).
function getIndexSteps() {
  const steps = [];

  addStep(steps, '[data-guide="index-search"]', {
    title: 'Pencarian',
    description: 'Cari data berdasarkan kata kunci tertentu.',
  });
  addStep(steps, '[data-guide="index-add-btn"]', {
    title: 'Tambah Data',
    description: 'Klik untuk menambahkan data baru.',
  });
  addStep(steps, '[data-guide="pagination-controls"]', {
    title: 'Jumlah Baris',
    description: 'Atur jumlah data yang ditampilkan per halaman, atau tampilkan semua data.',
  });
  addStep(steps, '[data-guide="index-bulk-delete"]', {
    title: 'Hapus Massal',
    description: 'Pilih beberapa data lewat checkbox, lalu klik tombol ini untuk menghapus sekaligus.',
  });
  addStep(steps, '[data-guide="index-table"]', {
    title: 'Daftar Data',
    description: 'Semua data yang tersimpan ditampilkan pada tabel ini.',
  });
  addStep(steps, '[data-guide="index-row-actions"]', {
    title: 'Aksi Baris',
    description: 'Edit atau hapus data pada baris yang bersangkutan.',
  });

  // Resource-specific: filter for Content Jurusan
  addStep(steps, '#form-filter-jurusan', {
    title: 'Filter Jurusan',
    description: 'Pilih jurusan untuk menampilkan konten khusus jurusan tersebut.',
  });



  return steps;
}

// Langkah khusus halaman form (dipakai bersama oleh create & edit).
function getFormSteps() {
  const steps = [];

   addStep(steps, '[data-guide="form-input"]', {
    title: 'Isi Data',
    description: 'Lengkapi seluruh field yang wajib diisi (bertanda required).',
  });
  addStep(steps, '[data-guide="form-dropzone"]', {
    title: 'Upload Gambar',
    description: 'Klik atau seret & lepas file gambar ke area ini untuk mengunggah.',
  });
  addStep(steps, '[data-guide="form-add-image"]', {                       // ⬅ baru
    title: 'Tambah Gambar',
    description: 'Klik untuk menambah baris upload gambar lagi (bisa lebih dari satu).',
  });
  addStep(steps, '[data-guide="form-existing-images"]', {                 // ⬅ baru
    title: 'Gambar Yang Sudah Ada',
    description: 'Klik ikon "×" pada gambar untuk menghapusnya. Perubahan berlaku setelah disimpan.',
  });
  addStep(steps, '[data-guide="form-submit"]', {
    title: 'Simpan',
    description: 'Klik untuk menyimpan data setelah semua form terisi dengan benar.',
  });
  addStep(steps, '[data-guide="form-back"]', {
    title: 'Kembali',
    description: 'Klik untuk kembali ke halaman daftar tanpa menyimpan perubahan.',
  });

  addStep(steps, '#elemen-list', {
    title: 'Elemen Konten',
    description: 'Daftar elemen (teks, gambar, link) yang menyusun konten pada bagian ini.',
    });

    addStep(steps, '[data-add-elemen="text"]', {
    title: 'Tambah Elemen',
    description: 'Klik salah satu tombol untuk menambahkan elemen Teks, Gambar, atau Link baru.',
    });


  return steps;
}

// FUNGSI BARU — taruh di dekat getFormSteps()/getIndexSteps()
function getDetailSteps() {
  const steps = [];
  addStep(steps, '[data-guide="detail-table"]', {
    title: 'Informasi Pesan',
    description: 'Detail lengkap data pengirim dan isi pesan yang dikirim.',
  });
  addStep(steps, '[data-guide="detail-actions"]', {
    title: 'Aksi',
    description: 'Balas pesan ini atau hapus jika sudah tidak diperlukan.',
  });

  // Jika ada modal balas pesan, tambahkan langkah khusus untuk modal
  addStep(steps, '#replyModal', {
    title: 'Balas Pesan',
    description: 'Pilih metode pengiriman, tulis pesan balasan, lalu kirim lewat WhatsApp atau Email.',
  });
  addStep(steps, '#reply-message', {
    title: 'Isi Balasan',
    description: 'Tulis teks balasan untuk pengirim. Gunakan template jika perlu.',
  });
  addStep(steps, '#btn-submit-reply', {
    title: 'Kirim Balasan',
    description: 'Kirim balasan via metode yang dipilih (WhatsApp atau Email).',
  });
  return steps;
}

function buildStepsForCurrentPage() {
  if (document.querySelector('[data-guide="dash-stats"]')) {
    return getDashboardSteps().concat(getLayoutSteps());
  }

  if (document.querySelector('[data-guide="detail-table"]')) {
    return getDetailSteps();
  }

  if (document.querySelector('[data-guide="form-input"]')) {
    return getFormSteps();
  }

  if (document.querySelector('[data-guide="index-table"]')) {
    return getIndexSteps();
  }

  return [];
}

function startTour() {
  const steps = buildStepsForCurrentPage();
  if (steps.length === 0) return;

  if (document.querySelector('[data-guide="dash-stats"]')) {
    activateGuideSidebarExpanded();
  }

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
    onDestroyed: deactivateGuideSidebarExpanded,
  });

  driverObj.drive();
}

export function initUserGuide() {
  const triggerBtn = document.getElementById('guide-trigger-btn');
  if (!triggerBtn) return; // tombol belum ada di layout => jangan lanjut

  triggerBtn.addEventListener('click', startTour);

  // Jalankan otomatis sekali saja untuk browser yang belum pernah lihat guide.
  if (!localStorage.getItem(STORAGE_KEY)) {
    setTimeout(startTour, 600);
    localStorage.setItem(STORAGE_KEY, 'true');
  }
}