$(document).ready(function () {
    // Hàm readURL để đọc và hiển thị tệp ảnh
    let readURL = function (input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }

            // Đọc tệp dưới dạng Data URL
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Gán sự kiện 'change' cho phần tử có lớp .file-upload
    $(".file-upload").on('change', function () {
        readURL(this); // Gọi hàm readURL khi tệp được chọn

        let fileData = new FormData();
        fileData.append('file', this.files[0]);

        let oldImage = $('#avt').data('old-src');
        fileData.append('oldImg', oldImage);

        //Gửi dữ liệu đến back-end
        NProgress.start();
        $.ajax({
            url: '/Web_HaiTrieu/auth/uploadAvatar/',
            type: 'POST',
            data: fileData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response['uploadAvt']) {
                    window.location.reload();
                }
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
        NProgress.done();
    });

    //Gán sự kiện click cho input
    $(".upload-button").on('click', function () {
        $(".file-upload").click();
    });


    //Xử lý thay đổi thông tin tài khoản Member
    $('.updateProfile').off('click').on('click', function () {

        let parent = $(this).parent().parent();
        parent.find('input[name="username"]').prop('disabled', false);
        parent.find('input[name="fullname"]').prop('disabled', false);
        parent.find('input[name="phone"]').prop('disabled', false);
        parent.find('input[name="address"]').prop('disabled', false);


        $(this).prop('disabled', true);
        $('.command').append(`<button class="confirm btn btn-primary pe-2"><i class="fa-solid fa-floppy-disk"></i> Lưu thông tin</button>`)
        $('.command').append(`&nbsp;<button class="cancel btn btn-secondary"><i class="fa-solid fa-rectangle-xmark"></i> Hủy</button>`)

        //Xử lý lưu thông tin
        $('.confirm').on('click', function () {
            let parent = $(this).parent().parent();
            let username = parent.find('input[name="username"]').val();
            let fullname = parent.find('input[name="fullname"]').val();
            let phone = parent.find('input[name="phone"]').val();
            let address = parent.find('input[name="address"]').val();

            let errors = false;

            //Validate UserName
            if (username == '') {
                let errorText = parent.find('.username-null');
                errorText.text('Vui lòng nhập Tên tài khoản!');
                setTimeout(function () {
                    errorText.text('');
                }, 2000);
                errors = true;
            } else if (checkLength(username, 4, 16) == false) {
                let errorText = parent.find('.username-null');
                errorText.text('Độ dài Tên tài khoản ít nhất 4 ký tự và tối đa 16 ký tự!');
                setTimeout(function () {
                    errorText.text('');
                }, 2000);
                errors = true;
            }

            //Validate FullName
            if (fullname == '') {
                let errorText = parent.find('.fname-null');
                errorText.text('Vui lòng nhập Họ Tên!');
                setTimeout(function () {
                    errorText.text('');
                }, 2000);
                errors = true;
            } else if (checkLength(fullname, 10, 64) == false) {
                let errorText = parent.find('.fname-null');
                errorText.text('Độ dài Họ Tên ít nhất 10 ký tự và tối đa 64 ký tự!');
                setTimeout(function () {
                    errorText.text('');
                }, 2000);
                errors = true;
            }

            //Validate Phone
            if (phone == '') {
                let errorText = parent.find('.phone-null');
                errorText.text('Vui lòng nhập số điện thoại!');
                setTimeout(function () {
                    errorText.text('');
                }, 2000);
                errors = true;
            } else if (checkLength(phone, 10, 11) == false || !isNumber(phone)) {
                let errorText = parent.find('.phone-null');
                errorText.text('Số điện thoại không hợp lệ!');
                setTimeout(function () {
                    errorText.text('');
                }, 4000);
                errors = true;
            }

            //Validate Address
            if (address == '') {
                let errorText = parent.find('.address-null');
                errorText.text('Vui lòng nhập số điện thoại!');
                setTimeout(function () {
                    errorText.text('');
                }, 2000);
                errors = true;
            } else if (checkLength(address, 10, 255) == false) {
                let errorText = parent.find('.address-null');
                errorText.text('Độ dài địa chỉ ít nhất 10 ký tự và tối đa 255 ký tự!');
                setTimeout(function () {
                    errorText.text('');
                }, 2000);
                errors = true;
            }

            if (errors == false) {
                NProgress.start();
                $.post('/Web_HaiTrieu/auth/update/', {
                    'username': username,
                    'fname': fullname,
                    'phone': phone,
                    'address': address
                }, (d) => {
                    if (d['update'] == true) {
                        location.reload();
                    }
                });
                NProgress.done();
            }
        });

        //Xử lý thoát
        $('.cancel').on('click', function () {
            NProgress.start();
            location.reload();
            NProgress.done();
        });
    });


    //Xử lý đổi mật khẩu
    $('.newpass').on('click', function () {
        let parent = $(this).parent().parent();
        let oldPass = parent.find(currentPassword).val();
        let newPass = parent.find(newPassword).val();
        let confirmPass = parent.find(confirmPassword).val();

        let errors = false;

        //Validate oldPass
        if (oldPass == '') {
            let errorText = parent.find('.oldPass-null');
            errorText.text('Vui lòng nhập mật khẩu cũ!');
            setTimeout(function () {
                errorText.text('');
            }, 2000);
            errors = true;
        }

        //Validate newPass
        if (newPass == '') {
            let errorText = parent.find('.newPass-null');
            errorText.text('Vui lòng nhập mật khẩu mới!');
            setTimeout(function () {
                errorText.text('');
            }, 2000);
            errors = true;
        } else if (checkLength(newPass, 6, 16) == false) {
            let errorText = parent.find('.newPass-null');
            errorText.text('Độ dài mật khẩu ít nhất 6 ký tự và tối đa 16 ký tự!');
            setTimeout(function () {
                errorText.text('');
            }, 2000);
            errors = true;
        } else {
            if (!(newPass === confirmPass)) {
                let errorText = parent.find('.confirmPass-null');
                errorText.text('Mật khẩu nhập lại không chính xác!');
                setTimeout(function () {
                    errorText.text('');
                }, 2000);
                errors = true;
            }
        }

        //Validate confirmPass
        if (confirmPass == '') {
            let errorText = parent.find('.confirmPass-null');
            errorText.text('Vui lòng nhập xác nhận mật khẩu mới!');
            setTimeout(function () {
                errorText.text('');
            }, 2000);
            errors = true;
        }

        if (errors == false) {
            NProgress.start();
            $.post('/Web_HaiTrieu/auth/changePass/', {
                'oldPass': oldPass,
                'newPass': newPass
            }, (d) => {
                if (d['changePass'] == true) {
                    let changePassText = $(changePass);
                    changePassText.text('Đổi mật khẩu thành công!');
                    setTimeout(function () {
                        changePassText.text('');
                    }, 2000);
                } else if (d['oldPass'] == false) {
                    let errorText = parent.find('.oldPass-null');
                    errorText.text('Mật khẩu cũ không chính xác!');
                    setTimeout(function () {
                        errorText.text('');
                    }, 2000);
                }
            });
            NProgress.done();
        }
    });
});