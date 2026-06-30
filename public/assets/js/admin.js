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
 */

import { initLoginPage } from './modules/login.js';
import { initElemenBuilder } from './modules/elemen-builder.js';
import { initReplyModal } from './modules/reply-modal.js';
import { initContentJurusanCreate } from './modules/content-jurusan-create.js';
import { initContentJurusanEdit } from './modules/content-jurusan-edit.js';
import { initKeungulanCreate } from './modules/keungulan-create.js';

document.addEventListener('DOMContentLoaded', () => {
  initLoginPage();
  initElemenBuilder();
  initReplyModal();
  initContentJurusanCreate();
  initContentJurusanEdit();
  initKeungulanCreate();
});