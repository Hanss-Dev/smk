/**
 * admin-alerts.js
 * Global SweetAlert2 handlers for the admin panel.
 *
 * Loaded as a plain (non-module) script AFTER sweetalert2 CDN in admin.blade.php.
 * Uses event DELEGATION on document so it works regardless of when the DOM is ready
 * and avoids DOMContentLoaded timing issues caused by deferred module scripts.
 */

// ── 1. Delete Form Confirmation (event delegation) ────────────────────────────
//    Catches submit from any .form-delete, whenever it fires.
document.addEventListener('submit', function (e) {
    var form = e.target.closest('.form-delete');
    if (!form) return;

    e.preventDefault();
    e.stopImmediatePropagation();

    var message = form.dataset.confirmMessage || 'Yakin ingin menghapus data ini?';

    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then(function (result) {
        if (result.isConfirmed) {
            // Submit tanpa trigger event lagi (menghindari loop)
            HTMLFormElement.prototype.submit.call(form);
        }
    });
});

// ── 2. Logout Link Confirmation (event delegation) ────────────────────────────
document.addEventListener('click', function (e) {
    var link = e.target.closest('.logout-link');
    if (!link) return;

    e.preventDefault();

    Swal.fire({
        title: 'Konfirmasi Logout',
        text: link.dataset.confirmMessage || 'Yakin ingin logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then(function (result) {
        if (result.isConfirmed) {
            window.location.href = link.href;
        }
    });
});

// ── 3. Utility Functions (tetap tersedia global) ──────────────────────────────
window.confirmDelete = function (message, callback) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then(function (result) {
        if (result.isConfirmed) {
            callback();
        }
    });
};

window.confirmAction = function (message, callback) {
    Swal.fire({
        title: 'Konfirmasi',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Lanjutkan!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then(function (result) {
        if (result.isConfirmed) {
            callback();
        }
    });
};