$(document).ready(function () {


    if (quantityProductInCart() === 0) {
        let nullCart = "Bạn chưa thêm sản phẩm nào vào giỏ hàng!";
        $('.footer-cart').append(`<tr><td rowspan="5" colspan="5" class="text-center">${nullCart}</td></tr>`);
        $('.checkout').prop('disabled', true);
    }
    totalPriceOrders();


    //Hàm đếm số lượng sản phẩm có trong giỏ hàng
    function quantityProductInCart() {
        let cart = $("#cart").children('tr');
        let qty = cart.length;
        $("#box-cart").text(qty);
        return qty;
    };

    //Xử lý xóa sản phẩm trong giỏ hàng
    $(".del").click(function () {

        let tr = $(this).parent();
        let id = tr.attr('v');

        NProgress.start();
        $.post('/Web_HaiTrieu/cart/delete/', { 'id': id }, (d) => {
            if (d === 1) {
                tr.remove();

                if (quantityProductInCart() === 0) {
                    let nullCart = "Bạn chưa thêm sản phẩm nào vào giỏ hàng!";
                    $('.footer-cart').append(`<tr><td rowspan="5" colspan="5" class="text-center">${nullCart}</td></tr>`);
                }
                totalPriceOrders();
            }
        });
        NProgress.done();

        //Tạo hiệu ứng cho giỏ hàng
        $('#CartAni').addClass('cartAni');
        setTimeout(function () { $('#CartAni').removeClass('cartAni') }, 500);
    });

    //Xử lý giảm số lượng của sản phẩm trong giỏ hàng
    $(".btn-minus").click(function () {
        let id = $(this).closest('tr').attr('v');
        let qty = $(this).closest('tr').find("td input").val();
        if (qty > 0) {
            let subTotal = $(this).closest('tr').find('td .sub-total').text();
            let number = parseInt(subTotal.replace(/\./g, ''), 10);//chuyển dạng chuỗi sang số nguyên
            let Total = (number * qty).toLocaleString('de-DE');//chuyển dạng số theo dạng tiền 1.000.000

            $(this).closest('tr').find('td .total-price').text(Total);
            updateQuantityByProduct(id, qty);
        }
    });

    //Xử lý tăng số lượng của sản phẩm trong giỏ hàng
    $(".btn-plus").click(function () {

        let id = $(this).closest('tr').attr('v');
        let qty = $(this).closest('tr').find("td input").val();
        if (qty > 0) {
            let subTotal = $(this).closest('tr').find('td .sub-total').text();
            let number = parseInt(subTotal.replace(/\./g, ''), 10);
            let Total = (number * qty).toLocaleString('de-DE');

            $(this).closest('tr').find('td .total-price').text(Total);
            updateQuantityByProduct(id, qty);
        }
    });

    //Hàm cập nhật giỏ hàng
    function updateQuantityByProduct(id, qty) {
        NProgress.start();
        $.post('/Web_HaiTrieu/cart/update', {
            'id': id,
            'qty': qty
        }, (d) => {
            if (d === 1) {
                totalPriceOrders();
            }
        });
        NProgress.done();
    };

    //Hàm tính tổng tiền tạm thời 
    function totalPriceOrders() {
        let cart = $('#cart').children('tr');
        let Total = 0;
        for (let i = 0; i < cart.length; i++) {
            Total += parseInt((cart.eq(i).find('td .total-price').text()).replace(/\./g, ''), 10);
        }
        $('.total-demo span').text(Total.toLocaleString('de-DE'));
        $('.total span').text(Total.toLocaleString('de-DE'));
    };

    //Xử lý Checkout
    $('.checkout').on('click', function () {
        NProgress.start();
        if (quantityProductInCart() > 0) {
            let finalTotal = isInt($(this).parent().parent().find('.total span').text());
            console.log(finalTotal);
            let ordersDetail = $(this).parent().parent().find('.ordersDetail');
            let subTotal = isInt(ordersDetail.find('.total-demo span').text());

            // Tạo một biểu mẫu mới
            let form = $('<form>', {
                'action': '/Web_HaiTrieu/cart/checkout',
                'method': 'POST'
            });
            // Thêm các dữ liệu cần thiết vào biểu mẫu
            form.append($('<input>', {
                'type': 'hidden',
                'name': 'subTotal',
                'value': subTotal
            }));

            form.append($('<input>', {
                'type': 'hidden',
                'name': 'finalTotal',
                'value': finalTotal
            }));
            // Thêm biểu mẫu vào body và tự động gửi biểu mẫu
            form.appendTo('body').submit();
        }
        NProgress.done();
    });

    // Hàm chuyển sang số nguyên
    function isInt(input) {
        if (typeof input === 'string') {
            input = input.replace(/\./g, '');
        }
        return parseInt(input, 10);
    }
})
