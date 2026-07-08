/**
 * admin.js
 * Entry point for all admin-panel page scripts.
 *
 * Include this once via:
 *   <script type="module" src="{{ asset('assets/js/admin/admin.js') }}"></script>
 *
 * Each module self-detects whether its target markup exists on the
 * current page, so this single entry file is safe to load on every
 * admin page (login, create/edit forms, pesan/index, etc.).
 *
 * ── User guide ──────────────────────────────────────────────────────
 * There is no more single/global user guide. Every view (dashboard,
 * and every index/create/edit page except shared layout components)
 * has its own dedicated guide module under `modules/guides/*.guide.js`
 * with its own steps, title/description text, and its own "seen"
 * flag. Each one self-detects via a `data-guide-page="..."` marker
 * (or, for the dashboard, via its existing `data-guide="dash-stats"`
 * marker) and is a no-op on every other page.
 */

import { initLoginPage } from './modules/login.js';
import { initElemenBuilder } from './modules/elemen-builder.js';
import { initReplyModal } from './modules/reply-modal.js';
import { initContentJurusanCreate } from './modules/content-jurusan-create.js';
import { initContentJurusanEdit } from './modules/content-jurusan-edit.js';
import { initKeungulanCreate } from './modules/keungulan-create.js';
import { initFormValidation } from './modules/form-validation.js';

// ── Per-view user guides ─────────────────────────────────────────────
import { initDashboardGuide } from './modules/guides/dashboard.guide.js';
import { initPesanIndexGuide } from './modules/guides/pesan-index.guide.js';
import { initPesanReadGuide } from './modules/guides/pesan-read.guide.js';

import { initAlumniIndexGuide } from './modules/guides/alumni-index.guide.js';
import { initAlumniCreateGuide } from './modules/guides/alumni-create.guide.js';
import { initAlumniEditGuide } from './modules/guides/alumni-edit.guide.js';

import { initContentJurusanIndexGuide } from './modules/guides/content-jurusan-index.guide.js';
import { initContentJurusanCreateGuide } from './modules/guides/content-jurusan-create.guide.js';
import { initContentJurusanEditGuide } from './modules/guides/content-jurusan-edit.guide.js';

import { initHighlightIndexGuide } from './modules/guides/highlight-index.guide.js';
import { initHighlightCreateGuide } from './modules/guides/highlight-create.guide.js';
import { initHighlightEditGuide } from './modules/guides/highlight-edit.guide.js';

import { initKeungulanIndexGuide } from './modules/guides/keungulan-index.guide.js';
import { initKeungulanCreateGuide } from './modules/guides/keungulan-create.guide.js';
import { initKeungulanEditGuide } from './modules/guides/keungulan-edit.guide.js';

import { initLabIndexGuide } from './modules/guides/lab-index.guide.js';
import { initLabCreateGuide } from './modules/guides/lab-create.guide.js';
import { initLabEditGuide } from './modules/guides/lab-edit.guide.js';

import { initNewsIndexGuide } from './modules/guides/news-index.guide.js';
import { initNewsCreateGuide } from './modules/guides/news-create.guide.js';
import { initNewsEditGuide } from './modules/guides/news-edit.guide.js';

import { initPodcastIndexGuide } from './modules/guides/podcast-index.guide.js';
import { initPodcastCreateGuide } from './modules/guides/podcast-create.guide.js';
import { initPodcastEditGuide } from './modules/guides/podcast-edit.guide.js';

import { initPopupIndexGuide } from './modules/guides/popup-index.guide.js';
import { initPopupCreateGuide } from './modules/guides/popup-create.guide.js';
import { initPopupEditGuide } from './modules/guides/popup-edit.guide.js';

import { initSafetyRidingIndexGuide } from './modules/guides/safety-riding-index.guide.js';
import { initSafetyRidingCreateGuide } from './modules/guides/safety-riding-create.guide.js';
import { initSafetyRidingEditGuide } from './modules/guides/safety-riding-edit.guide.js';

document.addEventListener('DOMContentLoaded', () => {
  initLoginPage();
  initElemenBuilder();
  initReplyModal();
  initContentJurusanCreate();
  initContentJurusanEdit();
  initKeungulanCreate();
  initFormValidation();

  // Per-view user guides (each is a no-op unless its own page marker is found)
  initDashboardGuide();
  initPesanIndexGuide();
  initPesanReadGuide();

  initAlumniIndexGuide();
  initAlumniCreateGuide();
  initAlumniEditGuide();

  initContentJurusanIndexGuide();
  initContentJurusanCreateGuide();
  initContentJurusanEditGuide();

  initHighlightIndexGuide();
  initHighlightCreateGuide();
  initHighlightEditGuide();

  initKeungulanIndexGuide();
  initKeungulanCreateGuide();
  initKeungulanEditGuide();

  initLabIndexGuide();
  initLabCreateGuide();
  initLabEditGuide();

  initNewsIndexGuide();
  initNewsCreateGuide();
  initNewsEditGuide();

  initPodcastIndexGuide();
  initPodcastCreateGuide();
  initPodcastEditGuide();

  initPopupIndexGuide();
  initPopupCreateGuide();
  initPopupEditGuide();

  initSafetyRidingIndexGuide();
  initSafetyRidingCreateGuide();
  initSafetyRidingEditGuide();
});
