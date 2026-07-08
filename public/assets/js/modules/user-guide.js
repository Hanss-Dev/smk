/**
 * modules/user-guide.js
 *
 * Generic per-page "user guide" (tour) runner built on driver.js.
 *
 * IMPORTANT — this file no longer owns any content:
 * there is NO shared step catalogue / metaMap here anymore.
 * Every admin view defines its OWN steps (title + description) in its
 * own dedicated file under `modules/guides/*.guide.js` and calls
 * `initPageGuide(pageId, steps)` directly. This module only knows how to:
 *   1) resolve the steps that actually exist/are visible on the page,
 *   2) wire up the floating "?" trigger button (#guide-trigger-btn),
 *   3) auto-run the tour once per page on a visitor's first visit.
 *
 * Each page gets its own "seen" flag (namespaced by pageId) in
 * localStorage, so visiting one view for the first time no longer
 * marks the tour as "seen" for every other view (this is what caused
 * the dashboard tour to silently never appear before).
 */
import { driver } from '../vendor/driver.js.mjs';

const STORAGE_PREFIX = 'admin_guide_seen_v1';

/**
 * @typedef {Object} GuideStep
 * @property {string|Element} target - CSS selector (or element) to highlight
 * @property {string} title
 * @property {string} description
 * @property {() => boolean} [condition] - optional extra visibility guard
 */

function resolveStep(step) {
  const el = typeof step.target === 'string' ? document.querySelector(step.target) : step.target;
  if (!el) return null;

  if (typeof step.condition === 'function' && !step.condition()) return null;

  const style = window.getComputedStyle(el);
  const isVisible = style.display !== 'none' && style.visibility !== 'hidden' && el.offsetParent !== null;
  if (!isVisible) return null;

  return {
    element: el,
    popover: {
      title: step.title,
      description: step.description,
    },
  };
}

function buildDriverSteps(steps) {
  return steps.map(resolveStep).filter(Boolean);
}

function runTour(steps) {
  const driverSteps = buildDriverSteps(steps);
  if (driverSteps.length === 0) return;

  const driverObj = driver({
    showProgress: true,
    allowClose: true,
    overlayOpacity: 0.6,
    stagePadding: 6,
    nextBtnText: 'Lanjut',
    prevBtnText: 'Kembali',
    doneBtnText: 'Selesai',
    progressText: '{{current}} dari {{total}}',
    steps: driverSteps,
  });

  driverObj.drive();
}

/**
 * Register and (on first visit) auto-run the guide for the current page.
 *
 * @param {string} pageId - unique id for this view, e.g. "alumni-index"
 * @param {GuideStep[]} steps - steps for this view, in the order they
 *   should be shown. Each view supplies its own titles/descriptions —
 *   nothing is looked up from a shared/global map.
 */
export function initPageGuide(pageId, steps) {
  const triggerBtn = document.getElementById('guide-trigger-btn');
  if (!triggerBtn || !pageId || !Array.isArray(steps) || steps.length === 0) return;

  const storageKey = `${STORAGE_PREFIX}:${pageId}`;

  const startTour = () => runTour(steps);

  triggerBtn.addEventListener('click', startTour);

  if (!localStorage.getItem(storageKey)) {
    setTimeout(startTour, 600);
    localStorage.setItem(storageKey, 'true');
  }
}
