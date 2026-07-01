/**
 * modules/login.js
 * Handles: password show/hide toggle + today's date display on login page.
 * Required markup (see login.blade.php):
 *   <input id="password">
 *   <span id="eye-icon" data-toggle-pass>...</span>
 *   <p id="today-date"></p>
 */

export function initLoginPage() {
  const passwordInput = document.getElementById('password');
  const eyeIcon = document.getElementById('eye-icon');
  const dateEl = document.getElementById('today-date');

  const toggleBtn = document.querySelector('[data-toggle-pass]');
  if (passwordInput && eyeIcon && toggleBtn) {
    toggleBtn.addEventListener('click', () => togglePasswordVisibility(passwordInput, eyeIcon));
  }

  if (dateEl) {
    renderTodayDate(dateEl);
  }
}

function togglePasswordVisibility(input, icon) {
  const isHidden = input.type === 'password';
  input.type = isHidden ? 'text' : 'password';
  icon.style.color = isHidden ? '#4f46e5' : '';
}

function renderTodayDate(el) {
  const opts = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
  el.textContent = new Date().toLocaleDateString('en-GB', opts);
}