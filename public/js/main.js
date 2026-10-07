/**
 * LEGIT CHEMICAL - Main JavaScript Utilities
 */

document.addEventListener('DOMContentLoaded', function () {
    // Initialize Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Auto dismiss bootstrap alerts after 5s
    setTimeout(function () {
        var alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function (alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
});

/**
 * Image Switcher for Product Detail
 */
function changeProductImage(src) {
    var mainImg = document.getElementById('mainProductImage');
    if (mainImg) {
        mainImg.style.opacity = '0.4';
        setTimeout(function () {
            mainImg.src = src;
            mainImg.style.opacity = '1';
        }, 150);
    }
}

/**
 * SweetAlert2 Confirmation Dialog
 */
function confirmAction(formId, title, text, confirmBtnText, icon) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: title || 'Konfirmasi',
            text: text || 'Apakah Anda yakin ingin melanjutkan?',
            icon: icon || 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0B3B82',
            cancelButtonColor: '#64748B',
            confirmButtonText: confirmBtnText || 'Ya, Lanjutkan',
            cancelButtonText: 'Batal'
        }).then(function (result) {
            if (result.isConfirmed) {
                var form = document.getElementById(formId);
                if (form) form.submit();
            }
        });
    } else {
        if (confirm(text || 'Apakah Anda yakin?')) {
            var form = document.getElementById(formId);
            if (form) form.submit();
        }
    }
}
