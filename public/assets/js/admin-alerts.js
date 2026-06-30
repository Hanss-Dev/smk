function confirmDelete(message, callback) {
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
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
        }
    });
}

// Global Delete Confirmation for Forms
document.addEventListener('DOMContentLoaded', function () {
    const deleteForms = document.querySelectorAll('.form-delete');
    deleteForms.forEach(form => {
        // Prevent multiple listeners if re-initialized
        if (form.dataset.swalBound) return;
        form.dataset.swalBound = "true";

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const message = this.dataset.confirmMessage || 'Yakin ingin menghapus data ini?';
            
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
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});

// Global Function for Inline JS Confirmations
window.confirmAction = function(message, callback) {
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
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
        }
    });
};

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.logout-link').forEach(link => {

        link.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Konfirmasi Logout',
                text: this.dataset.confirmMessage,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {
                    window.location.href = this.href;
                }

            });

        });

    });

});