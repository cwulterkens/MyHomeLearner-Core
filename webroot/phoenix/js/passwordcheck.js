$(document).ready(function () {
    var passwordInput = $('#newPassword');

    passwordInput.on('input', function () {
        var password = passwordInput.val();

        // Check lowercase letter
        if (/(?=.*[a-z])/.test(password)) {
            $('#lowercase').removeClass('badge bg-danger').addClass('badge bg-success');
        } else {
            $('#lowercase').removeClass('badge bg-success').addClass('badge bg-danger');
        }

        // Check uppercase letter
        if (/(?=.*[A-Z])/.test(password)) {
            $('#uppercase').removeClass('badge bg-danger').addClass('badge bg-success');
        } else {
            $('#uppercase').removeClass('badge bg-success').addClass('badge bg-danger');
        }

        // Check digit
        if (/(?=.*\d)/.test(password)) {
            $('#number').removeClass('badge bg-danger').addClass('badge bg-success');
        } else {
            $('#number').removeClass('badge bg-success').addClass('badge bg-danger');
        }

        // Check special character
        if (/(?=.*[!@#$%^&*()_+])/.test(password)) {
            $('#special').removeClass('badge bg-danger').addClass('badge bg-success');
        } else {
            $('#special').removeClass('badge bg-success').addClass('badge bg-danger');
        }

        // Check length
        if (password.length >= 8) {
            $('#length').removeClass('badge bg-danger').addClass('badge bg-success');
        } else {
            $('#length').removeClass('badge bg-success').addClass('badge bg-danger');
        }
    });

    $('#resetPasswordForm').on('submit', function (e) {
        if ($('.text-danger').length > 0) {
            e.preventDefault();
            alert('Please fix the errors in the form.');
        }
    });
});
