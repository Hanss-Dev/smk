import { driver } from '../vendor/driver.js.mjs';

const STORAGE_KEY = 'admin_guide_seen_v1';

function addStep(steps, selector, popover) {
  const el = document.querySelector(selector);
  if (el) {
    steps.push({ element: selector, popover });
  }
}

// Langkah umum: header + sidebar, tampil di semua halaman admin.
function getLayoutSteps() {
  const steps = [];

  addStep(steps, '[data-guide="menu-toggle"]', {
    title: 'Menu Utama',
    description: 'Klik ikon ini untuk membuka/menutup sidebar di layar kecil (HP/tablet).',
  });

  addStep(steps, '[data-guide="sidebar-toggle"]', {
    title: 'Perkecil Sidebar',
    description: 'Klik untuk mempersempit sidebar agar area kerja lebih luas.',
  });

  addStep(steps, '[data-guide="menu-dashboard"]', {
    title: 'Dashboard',
    description: 'Ringkasan statistik seluruh konten website.',
  });

  addStep(steps, '[data-guide="menu-konten"]', {
    title: 'Kelola Konten',
    description: 'Kelola Berita, Highlight, Popup, Alumni, Keunggulan, dan Content Jurusan.',
  });

  addStep(steps, '[data-guide="menu-halaman"]', {
    title: 'Kelola Halaman',
    description: 'Kelola konten Podcast, Lab Komputer, dan Safety Riding.',
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
  return steps;
}

function buildStepsForCurrentPage() {
  let steps = getLayoutSteps();

  if (document.querySelector('[data-guide="dash-stats"]')) {
    steps = steps.concat(getDashboardSteps());
  } else if (document.querySelector('[data-guide="detail-table"]')) {   // ⬅ baru
    steps = steps.concat(getDetailSteps());
  } else if (document.querySelector('[data-guide="form-input"]')) {
    steps = steps.concat(getFormSteps());
  } else if (document.querySelector('[data-guide="index-table"]')) {
    steps = steps.concat(getIndexSteps());
  }

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
  if (!triggerBtn) return; // tombol belum ada di layout => jangan lanjut

  triggerBtn.addEventListener('click', startTour);

  // Jalankan otomatis sekali saja untuk browser yang belum pernah lihat guide.
  if (!localStorage.getItem(STORAGE_KEY)) {
    setTimeout(startTour, 600);
    localStorage.setItem(STORAGE_KEY, 'true');
  }
}