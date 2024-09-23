$(document).ready(function () {
    $('input[type="text"]').on('keypress', function (event) {
        var charCode = (event.which) ? event.which : event.keyCode;
        if (charCode < 48 || charCode > 57) {
            event.preventDefault();
        }
    });
});