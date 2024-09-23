//Function Validate Email
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

//Xử lý Login
$('.login-button').click(function () {
    var email = $(this).parent().parent().find('#inputEmail').val();
    var pwd = $(this).parent().parent().find('#inputPassword').val();
    var rem = $(this).parent().parent().find('#inputRememberPassword');
    if (rem.prop('checked')) {
        var remember = rem.val();
    } else {
        var remember = 0;
    }

    var errors = false;

    //Validate Email
    if (email == '') {
        const errorText = $(this).parent().parent().find('.email-null');
        errorText.text('Vui lòng nhập Email!');
        setTimeout(function () {
            errorText.text('');
        }, 2000);
        errors = true;
    } else if (isEmail(email) == false) {
        const errorText = $(this).parent().parent().find('.email-null');
        errorText.text('Email không hợp lệ!');
        setTimeout(function () {
            errorText.text('');
        }, 2000);
        errors = true;
    }

    //Validate Password
    if (pwd == '') {
        const errorText = $(this).parent().parent().find('.pwd-null');
        errorText.text('Vui lòng nhập mật khẩu!');
        setTimeout(function () {
            errorText.text('');
        }, 2000);
        errors = true;
    }

    if (errors == false) {
        NProgress.start();
        $.post('/Web_HaiTrieu/admin/checkLogin', {
            'eml': email,
            'pwd': pwd,
            'rem': remember
        }, (d) => {
            if (d.checkPass !== undefined && d.checkPass == false) {
                var error = $('#login .login-result');
                error.text('Mật khẩu không chính xác!');
                setTimeout(function () {
                    error.text('');
                }, 2000);
            } else if (d.checkLogin !== undefined && d.checkLogin == false) {
                var error = $('#login .login-result');
                error.text('Tài khoản không tồn tại!');
                setTimeout(function () {
                    error.text('');
                }, 2000);
            } else {
                if (d.checkAdmin == true) {
                    window.location.href = '/Web_HaiTrieu/manager/index';
                } else {
                    var error = $('#login .login-result');
                    error.text('Bạn không có quyền truy cập!');
                    setTimeout(function () {
                        error.text('');
                    }, 2000);
                }
            }
            NProgress.done();
        });
    }
});