function signup() {
    document.querySelector(".login-form-container").style.cssText = "display: none;";
    document.querySelector(".signup-form-container").style.cssText = "display: block;";
    document.querySelector(".container").style.cssText = "background-color:#A01C27;";
    document.querySelector(".button-1").style.cssText = "display: none";
    document.querySelector(".button-2").style.cssText = "display: block";

};

function login() {
    document.querySelector(".signup-form-container").style.cssText = "display: none;";
    document.querySelector(".login-form-container").style.cssText = "display: block;";
    document.querySelector(".container").style.cssText = "background-color: #A01C27;";
    document.querySelector(".button-2").style.cssText = "display: none";
    document.querySelector(".button-1").style.cssText = "display: block";
}

$(document).ready(function () {
    //Xử lý Register
    $('#register .signup-button').click(function () {
        var user = $(this).parent().find('input[name="user"]').val();
        var email = $(this).parent().find('input[name="email"]').val();
        var gender = $(this).parent().find('input[name="gender"]:checked').val();
        var pwd = $(this).parent().find('input[name="pwd"]').val();
        var errors = false;

        //Validate UserName
        if (user == '') {
            const errorText = $(this).parent().find('.user-null');
            errorText.text('Vui lòng nhập tên tài khoản!');
            setTimeout(function () {
                errorText.text('');
            }, 2000);
            errors = true;
        } else if (checkLength(user, 4, 16) == false) {
            const errorText = $(this).parent().find('.user-null');
            errorText.text('Độ dài tên đăng nhập ít nhất 4 ký tự và tối đa 16 ký tự!');
            setTimeout(function () {
                errorText.text('');
            }, 2000);
            errors = true;
        }

        //Validate Email
        if (email == '') {
            const errorText = $(this).parent().find('.email-null');
            errorText.text('Vui lòng nhập Email!');
            setTimeout(function () {
                errorText.text('');
            }, 2000);
            errors = true;
        } else if (isEmail(email) == false) {
            const errorText = $(this).parent().find('.email-null');
            errorText.text('Email không hợp lệ!');
            setTimeout(function () {
                errorText.text('');
            }, 2000);
            errors = true;
        }

        //Validate Gender
        if (gender == undefined) {
            const errorText = $(this).parent().find('.gender-null');
            errorText.text('Vui lòng chọn giới tính!');
            setTimeout(function () {
                errorText.text('');
            }, 2000);
            errors = true;
        }

        //Validate Password
        if (pwd == '') {
            const errorText = $(this).parent().find('.pwd-null');
            errorText.text('Vui lòng nhập mật khẩu!');
            setTimeout(function () {
                errorText.text('');
            }, 2000);
            errors = true;
        } else if (checkLength(pwd, 6, 16) == false) {
            const errorText = $(this).parent().find('.pwd-null');
            errorText.text('Độ dài mật khẩu ít nhất 6 ký tự và tối đa 16 ký tự!');
            setTimeout(function () {
                errorText.text('');
            }, 2000);
            errors = true;
        }

        if (errors == false) {
            NProgress.start();
            $.post('/Web_HaiTrieu/auth/register', {
                'user': user,
                'eml': email,
                'gender': gender,
                'pwd': pwd
            }, (d) => {
                if (d == 1) {
                    //Clear text
                    $(this).parent().find('input[name="user"]').val('');
                    $(this).parent().find('input[name="email"]').val('');
                    $(this).parent().find('input[name="gender"]:checked').prop('checked', false);
                    $(this).parent().find('input[name="pwd"]').val('');
                    login();
                    var registerSuccess = $('#login .register-result');
                    registerSuccess.text('Đăng ký tài khoản thành công!');
                    setTimeout(function () {
                        registerSuccess.text('');
                    }, 2000);
                } else {
                    var registerError = $('#register .register-result');
                    registerError.text('Email đã tồn tại!');
                    setTimeout(function () {
                        registerError.text('');
                    }, 2000);

                    //Clear text
                    $(this).parent().find('input[name="user"]').val('');
                    $(this).parent().find('input[name="email"]').val('');
                    $(this).parent().find('input[name="gender"]:checked').prop('checked', false);
                    $(this).parent().find('input[name="pwd"]').val('');
                }
                NProgress.done();
            });
        }
    });

    //Xử lý Login
    $('#login .login-button').click(function () {
        var email = $(this).parent().find('input[name="email"]').val();
        var pwd = $(this).parent().find('input[name="pwd"]').val();
        var rem = $(this).parent().find('.remember input[name="rem"]');
        if (rem.prop('checked')) {
            var remember = rem.val();
        } else {
            var remember = 0;
        }
        var errors = false;

        //Validate Email
        if (email == '') {
            const errorText = $(this).parent().find('.email-null');
            errorText.text('Vui lòng nhập Email!');
            setTimeout(function () {
                errorText.text('');
            }, 2000);
            errors = true;
        } else if (isEmail(email) == false) {
            const errorText = $(this).parent().find('.email-null');
            errorText.text('Email không hợp lệ!');
            setTimeout(function () {
                errorText.text('');
            }, 2000);
            errors = true;
        }

        //Validate Password
        if (pwd == '') {
            const errorText = $(this).parent().find('.pwd-null');
            errorText.text('Vui lòng nhập mật khẩu!');
            setTimeout(function () {
                errorText.text('');
            }, 2000);
            errors = true;
        }

        if (errors == false) {
            NProgress.start();
            $.post('/Web_HaiTrieu/auth/login', {
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
                    if (d.checkPass == true) {
                        window.location.href = '/Web_HaiTrieu';
                    }
                }
                NProgress.done();
            });
        }
    });
});
