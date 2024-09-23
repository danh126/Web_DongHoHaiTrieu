//Hủy checkout
$(window).on('beforeunload', function () {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '/Web_HaiTrieu/cart/resetCheckout', false); // 'false' để thực hiện đồng bộ
    xhr.send();
});

//Xử lý disable khi có thông tin
let parentProfile = $(profile);

parentProfile.find('input[name="fname"]').val() != '' ? $('input[name="fname"]').prop('disabled', true) : '';
parentProfile.find('input[name="eml"]').val() != '' ? $('input[name="eml"]').prop('disabled', true) : '';
parentProfile.find('input[name="phone"]').val() != '' ? $('input[name="phone"]').prop('disabled', true) : '';
parentProfile.find('input[name="address"]').val() != '' ? $('input[name="address"]').prop('disabled', true) : '';

//Xử lý nhập mã giảm giá
$('#coupon button').on('click', function () {
    let coupon = $(this).parent().parent().find('input').val();
    let subTotal = parseInt(($('.sub-total').text()).replace(/\./g, ''), 10);

    if (coupon == "") {
        $('#coupon-error').find('h6').text('Vui lòng nhập mã giảm giá!');
        setTimeout(function () {
            $('#coupon-error').find('h6').text('')
        }, 4000);
    } else {
        NProgress.start();
        $.post('/Web_HaiTrieu/cart/coupon', {
            'total': subTotal,
            'coupon': coupon
        }, (d) => {
            if (d['discount'] != null && d['finalTotal']) {
                let discount = d['discount'].toLocaleString('de-DE');
                $('.coupon-apply').append(`<h6 class="font-weight-medium">Giảm giá</h6><h6 class="font-weight-medium">- <span class="discount">${discount}</span>₫</h6>`)

                // Vô hiệu hóa nút nhập mã giảm giá sau lần nhập đầu tiên
                $('#coupon button').prop('disabled', true);
                $('#coupon input').prop('disabled', true);

                // Hiển thị thông báo rằng mã giảm giá đã được áp dụng
                $('#coupon-error').find('h6').text('Mã giảm giá đã được áp dụng!');
                setTimeout(function () {
                    $('#coupon-error').find('h6').text('')
                }, 4000);

                let finalTotal = d['finalTotal'].toLocaleString('de-DE');
                //Cập nhật lại tổng tiền
                $('.final-total span').text(finalTotal);

            } else {
                $('#coupon-error').find('h6').text('Mã giảm giá không tồn tại!');
                setTimeout(function () {
                    $('#coupon-error').find('h6').text('')
                }, 4000);
            }
            NProgress.done();
        });
    }
});

$('.confirmOrders').on('click', function () {
    let parent = $(this).closest(checkout);
    let fname = parent.find('input[name="fname"]').val();
    let email = parent.find('input[name="eml"]').val();
    let phone = parent.find('input[name="phone"]').val();
    let address = parent.find('input[name="address"]').val();
    let note = parent.find('textarea[name="note"]').val();

    let totalPrice = $('#finalTotal h5 span').text();
    let finalTotal = parseInt(totalPrice.replace(/\./g, ''), 10);

    //console.log(finalTotal);

    let discount = $('.coupon-apply').find('.discount').text();
    if (discount != "") {
        var orderDiscount = parseInt(discount.replace(/\./g, ''), 10);
    } else {
        var orderDiscount = 0;
    }

    let errors = false;

    //Validate FullName
    if (fname == '') {
        let errorText = parent.find('.fname-null');
        errorText.text('Vui lòng nhập Họ Tên!');
        setTimeout(function () {
            errorText.text('');
        }, 4000);
        errors = true;
    } else if (checkLength(fname, 4, 64) == false) {
        let errorText = parent.find('.fname-null');
        errorText.text('Độ dài Họ Tên ít nhất 4 ký tự và tối đa 64 ký tự!');
        setTimeout(function () {
            errorText.text('');
        }, 4000);
        errors = true;
    }

    //Validate Email
    if (email == '') {
        let errorText = parent.find('.eml-null');
        errorText.text('Vui lòng nhập Email!');
        setTimeout(function () {
            errorText.text('');
        }, 4000);
        errors = true;
    } else if (isEmail(email) == false) {
        const errorText = parent.find('.eml-null');
        errorText.text('Email không hợp lệ!');
        setTimeout(function () {
            errorText.text('');
        }, 4000);
        errors = true;
    }


    if (phone == '') {
        let errorText = parent.find('.phone-null');
        errorText.text('Vui lòng nhập số điện thoại!');
        setTimeout(function () {
            errorText.text('');
        }, 4000);
        errors = true;
    } else if (checkLength(phone, 10, 11) == false || !isNumber(phone)) {
        let errorText = parent.find('.phone-null');
        errorText.text('Số điện thoại không hợp lệ!');
        setTimeout(function () {
            errorText.text('');
        }, 4000);
        errors = true;
    }


    if (address == '') {
        let errorText = parent.find('.address-null');
        errorText.text('Vui lòng nhập địa chỉ giao hàng!');
        setTimeout(function () {
            errorText.text('');
        }, 4000);
        errors = true;
    }

    if (errors == false) {
        NProgress.start();
        $.post('/Web_HaiTrieu/cart/doCheckout', {
            'fname': fname,
            'eml': email,
            'phone': phone,
            'address': address,
            'note': note,
            'od': orderDiscount,
            'total': finalTotal
        }, (d) => {
            if (d.checkout == true) {
                let orderId = d.orderId;
                window.location.href = '/Web_HaiTrieu/cart/checkmark/' + orderId;
            }
        });
        NProgress.done();
    }
});