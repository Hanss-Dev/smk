/**
 * admin-tour.js
 * Guided admin tour for the admin panel.
 */

const tourState = {
  section: null,
  steps: [],
  currentIndex: 0,
  overlay: null,
  highlight: null,
  tooltip: null,
  description: null,
  counter: null,
  btnPrev: null,
  btnNext: null,
  btnClose: null,
};

function getTourSection() {
  const path = window.location.pathname;
  if (/\/admin\/dashboard(?:\/)?$/.test(path)) {
    return 'dashboard';
  }
  if (/\/admin\/(news|highlight|popup|alumni|content-jurusan|keungulan)(?:\/|$)/.test(path)) {
    return 'content';
  }
  if (/\/admin\/(podcast|lab|safety-riding)(?:\/|$)/.test(path)) {
    return 'page';
  }
  if (/\/admin\/pesan(?:\/|$)/.test(path)) {
    return 'pesan';
  }
  return null;
}

function getTourStorageKey() {
  return `admin_tour_seen:${tourState.section}`;
}

function getTourSteps() {
  const steps = [];
  const section = tourState.section;
  const pageTitle = document.querySelector('.content-header h1');
  const actionButton = document.querySelector('.content-wrapper .btn.btn-primary, .content-wrapper .btn.btn-info');
  const dashboardCard = document.querySelector('.dashboard-cards .small-box');
  const quickStats = document.querySelector('.quick-stats');
  const recentNews = document.querySelector('.recent-news');
  const messageList = document.querySelector('.table, .list-group, .card-body');

  if (section === 'dashboard') {
    const sidebar = document.querySelector('#sidebar-toggle-desktop');
    if (sidebar) {
      steps.push({
        title: 'Sidebar',
        description: 'Klik tombol ini untuk buka atau sembunyikan sidebar agar navigasi lebih lega.',
        selector: '#sidebar-toggle-desktop',
      });
    }

    if (dashboardCard) {
      steps.push({
        title: 'Ringkasan Dashboard',
        description: 'Ini adalah ringkasan utama dengan kartu statistik untuk setiap bagian penting.',
        selector: '.dashboard-cards .small-box',
      });
    }

    if (quickStats) {
      steps.push({
        title: 'Quick Statistics',
        description: 'Gunakan statistik cepat untuk melihat status berita, pesan, dan pengguna secara ringkas.',
        selector: '.quick-stats',
      });
    }

    if (recentNews) {
      steps.push({
        title: 'Berita Terbaru',
        description: 'Di sini Anda dapat melihat daftar berita terbaru dan status publikasinya.',
        selector: '.recent-news',
      });
    }

    return steps;
  }

  if (section === 'pesan' && messageList) {
    steps.push({
      title: 'Daftar Pesan',
      description: 'Di sini Anda dapat melihat pesan masuk dan membuka detail pesan.',
      selector: '.table, .list-group, .card-body',
    });
  }

  if ((section === 'content' || section === 'page') && pageTitle) {
    steps.push({
      title: 'Judul Halaman',
      description: 'Lihat judul halaman dan breadcrumb di bagian ini sebagai panduan posisi Anda.',
      selector: '.content-header h1',
    });
  }

  if ((section === 'content' || section === 'page') && actionButton) {
    steps.push({
      title: 'Tombol Aksi',
      description: 'Gunakan tombol ini untuk membuat atau mengelola data pada halaman ini.',
      selector: '.content-wrapper .btn.btn-primary, .content-wrapper .btn.btn-info',
    });
  }

  return steps;
}

function queryStepElements() {
  return tourState.steps
    .map((step) => {
      const element = document.querySelector(step.selector);
      return element ? { ...step, element } : null;
    })
    .filter(Boolean);
}

function setTooltipPosition(target, tooltip) {
  const padding = 12;
  const rect = target.getBoundingClientRect();
  const tooltipRect = tooltip.getBoundingClientRect();
  const viewportWidth = window.innerWidth;
  const viewportHeight = window.innerHeight;

  let top = rect.bottom + 12;
  let left = rect.left + rect.width / 2 - tooltipRect.width / 2;

  if (top + tooltipRect.height > viewportHeight - padding) {
    top = rect.top - tooltipRect.height - 12;
  }

  if (left < padding) {
    left = padding;
  } else if (left + tooltipRect.width > viewportWidth - padding) {
    left = viewportWidth - tooltipRect.width - padding;
  }

  if (top < padding) {
    top = padding;
  }

  tooltip.style.top = `${Math.max(top, padding)}px`;
  tooltip.style.left = `${left}px`;
}

function updateHighlight(target) {
  const rect = target.getBoundingClientRect();
  const margin = 8;
  tourState.highlight.style.width = `${Math.max(rect.width + margin * 2, 40)}px`;
  tourState.highlight.style.height = `${Math.max(rect.height + margin * 2, 40)}px`;
  tourState.highlight.style.left = `${Math.max(rect.left - margin, 8)}px`;
  tourState.highlight.style.top = `${Math.max(rect.top - margin, 8)}px`;
}

function showStep(index) {
  if (!tourState.steps.length) {
    return;
  }

  tourState.currentIndex = Math.max(0, Math.min(index, tourState.steps.length - 1));
  const step = tourState.steps[tourState.currentIndex];
  const target = step.element;

  window.requestAnimationFrame(() => {
    target.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' });
    if (step.autoClick && typeof target.click === 'function') {
      setTimeout(() => {
        target.click();
      }, 500);
    }
    setTimeout(() => {
      updateHighlight(target);
      tourState.tooltip.classList.add('active');
      tourState.highlight.style.display = 'block';
      tourState.tooltip.setAttribute('aria-hidden', 'false');
      tourState.btnPrev.disabled = tourState.currentIndex === 0;
      tourState.btnNext.textContent = tourState.currentIndex === tourState.steps.length - 1 ? 'Selesai' : 'Berikutnya';
      tourState.counter.textContent = `Langkah ${tourState.currentIndex + 1} dari ${tourState.steps.length}`;
      tourState.description.innerHTML = `<strong>${step.title}</strong><br>${step.description}`;
      setTooltipPosition(target, tourState.tooltip);
    }, 260);
  });
}

function showTour() {
  if (!tourState.steps.length) {
    return;
  }

  tourState.overlay.classList.add('active');
  tourState.overlay.setAttribute('aria-hidden', 'false');
  tourState.tooltip.style.display = 'block';
  showStep(0);
}

function hideTour() {
  tourState.overlay.classList.remove('active');
  tourState.overlay.setAttribute('aria-hidden', 'true');
  tourState.highlight.style.display = 'none';
  tourState.tooltip.classList.remove('active');
  tourState.tooltip.setAttribute('aria-hidden', 'true');
}

function handleNext() {
  if (tourState.currentIndex === tourState.steps.length - 1) {
    hideTour();
    localStorage.setItem(getTourStorageKey(), 'true');
    return;
  }
  showStep(tourState.currentIndex + 1);
}

function handlePrev() {
  showStep(tourState.currentIndex - 1);
}

function setupAdminTour() {
  tourState.section = getTourSection();
  if (!tourState.section) {
    return;
  }

  tourState.overlay = document.getElementById('admin-tour-overlay');
  tourState.highlight = document.getElementById('admin-tour-highlight');
  tourState.tooltip = document.getElementById('admin-tour-tooltip');
  tourState.description = document.getElementById('admin-tour-description');
  tourState.counter = document.getElementById('admin-tour-counter');
  tourState.btnPrev = document.getElementById('admin-tour-prev');
  tourState.btnNext = document.getElementById('admin-tour-next');
  tourState.btnClose = document.querySelector('.admin-tour-close');

  if (!tourState.overlay || !tourState.highlight || !tourState.tooltip || !tourState.btnClose) {
    return;
  }

  tourState.steps = getTourSteps();
  if (!tourState.steps.length) {
    return;
  }

  tourState.steps = queryStepElements();
  if (!tourState.steps.length) {
    return;
  }

  tourState.btnClose.addEventListener('click', () => {
    hideTour();
    localStorage.setItem(getTourStorageKey(), 'true');
  });

  tourState.btnNext.addEventListener('click', handleNext);
  tourState.btnPrev.addEventListener('click', handlePrev);
  tourState.overlay.addEventListener('click', (event) => {
    if (event.target === tourState.overlay) {
      hideTour();
      localStorage.setItem(getTourStorageKey(), 'true');
    }
  });

  window.addEventListener('resize', () => {
    if (tourState.overlay.classList.contains('active')) {
      showStep(tourState.currentIndex);
    }
  });

  const hasSeenTour = localStorage.getItem(getTourStorageKey()) === 'true';
  if (!hasSeenTour) {
    showTour();
  }
}

export function initAdminTour() {
  if (document.body.classList.contains('login-page')) {
    return;
  }
  setupAdminTour();
}
